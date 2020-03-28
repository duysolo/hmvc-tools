<?php

namespace HMVCTools\Console\Generators;

class MakeViewComposer extends AbstractGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make:composer
    	{alias : The alias of the module}
    	{name : The class name}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View composer handler';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/../../../resources/stubs/view-composers/composer.stub';
    }

    protected function getClass(string $name): string
    {
        return 'Http\ViewComposers\\' . $this->argument('name') . 'ViewComposer';
    }
}
