<?php

namespace HMVCTools\Console\Generators;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use stdClass;
use Symfony\Component\Process\Process;

class CreateModule extends Command
{
    const TYPE_CORE = 'core';

    const TYPE_PLUGINS = 'plugins';

    const TYPE_THEMES = 'themes';

    /**
     * @var string
     */
    protected $signature = 'module:create {alias : The alias of the module} {--autoload : Autoload module}';

    /**
     * @var string
     */
    protected $description = 'HMVC modules generator.';

    /**
     * @var Filesystem
     */
    protected $files;

    /**
     * Array to store the configuration details.
     *
     * @var array
     */
    protected $container = [];

    /**
     * Accepted module types
     * @var array
     */
    protected $acceptedTypes = [
        self::TYPE_CORE => 'Core',
        self::TYPE_PLUGINS => 'Plugins',
        self::TYPE_THEMES => 'Themes',
    ];

    protected $moduleType;

    protected $moduleFolderName;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->files = $filesystem;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->moduleType = $this->ask('Your module type. Accepted: core, plugins, themes.', self::TYPE_PLUGINS);

        if (!in_array($this->moduleType, array_keys($this->acceptedTypes))) {
            $this->moduleType = self::TYPE_PLUGINS;
        }

        $this->createFolderIfNotExists([
            'platform',
            'platform/' . $this->moduleType,
        ]);

        $this->container['alias'] = Str::slug($this->argument('alias'));

        $this->step1();

        $this->step2();
    }

    protected function step1()
    {
        $this->moduleFolderName = Str::slug($this->ask('Module folder name:', $this->container['alias']));

        $directory = base_path('platform/' . $this->moduleType . '/' . $this->moduleFolderName);

        if ($this->files->exists($directory)) {
            $this->error('The module path already exists');

            exit();
        }

        $this->container['description'] = $this->ask('Description of module:', '');
        $this->container['namespace'] = $this->ask(
            'Namespace of module:',
            $this->acceptedTypes[$this->moduleType] . '\\' . Str::studly($this->container['alias'])
        );
    }

    protected function step2()
    {
        $this->generatingModule();

        if ($this->option('autoload')) {
            $this->installModule();
        }

        $this->info("Your module generated successfully.");
        $this->info("Now, your module serving at: " . env('APP_URL') . "/{$this->container['alias']}");
    }

    protected function generatingModule()
    {
        $directory = base_path('platform/' . $this->moduleType . '/' . $this->moduleFolderName);

        if ($this->moduleType == self::TYPE_THEMES) {
            $source = __DIR__ . '/../../../resources/structures/theme';
        } else {
            $source = __DIR__ . '/../../../resources/structures/module';
        }

        /**
         * Make directory
         */
        $this->files->makeDirectory('platform/' . $this->moduleType . '/' . $this->moduleFolderName);
        $this->files->copyDirectory($source, $directory);

        try {
            $composerJSON = json_decode($this->files->get($directory . '/composer.json'), true);

            $composerJSON['name'] = $this->moduleType . '/' . $this->container['alias'];
            $composerJSON['description'] = $this->container['description'];
            $composerJSON['autoload']['psr-4'][$this->container['namespace'] . '\\'] = 'src/';
            $composerJSON['require'] = new stdClass();
            $composerJSON['require-dev'] = new stdClass();

            if ($this->option('autoload')) {
                $composerJSON['extra']['laravel']['providers'] = $this->container['namespace'] . '\\Providers\\ModuleServiceProvider';
            } else {
                $composerJSON['extra'] = new stdClass();
            }

            $moduleJSON = [];
            $moduleJSON = array_merge($moduleJSON, $this->container);

            $this->files->put($directory . '/composer.json', json_encode_prettify($composerJSON));
            $this->files->put($directory . '/module.json', json_encode_prettify($moduleJSON));

            /**
             * Replace files placeholder
             */
            $files = $this->files->allFiles($directory);

            foreach ($files as $file) {
                $contents = $this->replacePlaceholders($file->getContents());
                $filePath = base_path('platform/' . $this->moduleType . '/' . $this->moduleFolderName . '/' . $file->getRelativePathname());

                $this->files->put($filePath, $contents);
            }
        } catch (Exception $exception) {
            $this->files->deleteDirectory($directory);

            $this->error($exception->getMessage());

            exit();
        }
    }

    protected function replacePlaceholders($contents)
    {
        $find = [
            'DummyNamespace',
            'DummyAlias',
            'DummyType',
        ];

        $replace = [
            $this->container['namespace'],
            $this->container['alias'],
            $this->moduleType,
        ];

        return str_replace($find, $replace, $contents);
    }

    /**
     * @param array $names
     */
    protected function createFolderIfNotExists(array $names): void
    {
        foreach ($names as $name) {
            $directory = base_path($name);

            if (!$this->files->exists($directory)) {
                $this->files->makeDirectory($name);
            }
        }
    }

    protected function installModule(): void
    {
        $command = 'composer require ' . $this->moduleType . '/' . $this->moduleFolderName;
        $this->info($command);
        $process = Process::fromShellCommandline($command);
        $process->run();
        $this->info($process->getOutput());
    }
}
