<?php

namespace HMVCTools\Console\Generators;

class MakeView extends AbstractGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make:view
    	{alias : The alias of the module}
    	{name : View name}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $path = $this->modulePath() . 'resources/views/' . str_replace('\\', '/', $name) . '.blade.php';

        return $path;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/../../../resources/stubs/views/view.stub';
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getClass(string $name): string
    {
        return $this->getNameInput();
    }

    /**
     * @param $stub
     * @return string|string[]
     */
    protected function replaceParameters($stub)
    {
        $stub = str_replace([
            '{alias}',
        ], [
            $this->argument('alias'),
        ], $stub);

        return $stub;
    }
}
