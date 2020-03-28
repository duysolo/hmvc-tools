<?php

namespace HMVCTools\Providers;

use HMVCTools\Console\Generators\MakeCommand;
use HMVCTools\Console\Generators\MakeController;
use HMVCTools\Console\Generators\MakeFacade;
use HMVCTools\Console\Generators\MakeMiddleware;
use HMVCTools\Console\Generators\MakeMigration;
use HMVCTools\Console\Generators\MakeModel;
use HMVCTools\Console\Generators\CreateModule;
use HMVCTools\Console\Generators\MakeProvider;
use HMVCTools\Console\Generators\MakeRequest;
use HMVCTools\Console\Generators\MakeSupport;
use HMVCTools\Console\Generators\MakeView;
use HMVCTools\Console\Generators\MakeViewComposer;
use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            CreateModule::class,
            MakeProvider::class,
            MakeController::class,
            MakeMiddleware::class,
            MakeRequest::class,
            MakeModel::class,
            MakeFacade::class,
            MakeSupport::class,
            MakeView::class,
            MakeCommand::class,
            MakeViewComposer::class,
            MakeMigration::class,
        ]);
    }
}
