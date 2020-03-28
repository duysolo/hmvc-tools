<?php

namespace HMVCTools\Console\Generators;

class MakeController extends AbstractGenerator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make:controller
    	{alias : The alias of the module}
    	{name : The class name}
    	{--resource : Generate a controller with route resource}';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        if ($this->option('resource')) {
            return __DIR__ . '/../../../resources/stubs/controllers/controller.resource.stub';
        }

        return __DIR__ . '/../../../resources/stubs/controllers/controller.stub';
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getClass(string $name): string
    {
        return 'Http\\Controllers\\' . $name . 'Controller';
    }
}
