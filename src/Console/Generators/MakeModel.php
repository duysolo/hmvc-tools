<?php

namespace HMVCTools\Console\Generators;

class MakeModel extends AbstractGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make:model
    	{alias : The alias of the module}
    	{name : The class name}
    	{table : The table name}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/../../../resources/stubs/models/model.stub';
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getClass(string $name): string
    {
        return 'Models\\' . $this->argument('name');
    }

    /**
     * @param $stub
     * @return string|string[]
     */
    protected function replaceParameters($stub)
    {
        $stub = str_replace([
            '{table}',
        ], [
            $this->argument('table'),
        ], $stub
        );

        return $stub;
    }
}
