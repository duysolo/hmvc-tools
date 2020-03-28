<?php

namespace HMVCTools\Console\Generators;

use Illuminate\Support\Facades\Artisan;

class MakeMigration extends AbstractGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make:migration
    	{alias : The alias of the module}
    	{name : The class name}
    	{--create=}
    	{--table=}
    	';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migration';

    public function handle()
    {
        $this->moduleType = $this->ask('Your module type. Accepted: core, plugins, themes.', self::TYPE_PLUGINS);

        $this->moduleName = $this->getModuleName();

        Artisan::call('make:migration', [
            'name' => $this->getNameInput(),
            '--path' => 'platform/' . $this->moduleType . '/' . $this->moduleName . '/database/migrations',
            '--create' => $this->option('create'),
            '--table' => $this->option('table'),
        ]);

        $this->info($this->type . ' created successfully.');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return '';
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getClass(string $name): string
    {
        return '';
    }
}
