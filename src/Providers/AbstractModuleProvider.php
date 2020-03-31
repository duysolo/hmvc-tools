<?php

namespace HMVCTools\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

abstract class AbstractModuleProvider extends ServiceProvider
{
    const PUBLISH_ASSETS = 'assets';

    const PUBLISH_PUBLIC_ASSETS = 'public-assets';

    public function boot()
    {
        $this->loadViewsAndTranslations();

        $this->publishAssets();
    }

    protected function loadViewsAndTranslations()
    {
        $moduleName = $this->getModuleName();

        $dir = $this->getDir();

        /*Load views*/
        $this->loadViewsFrom($dir . '/../../resources/views', $moduleName);

        /*Load translations*/
        $this->loadTranslationsFrom($dir . '/../../resources/lang', $moduleName);

        $this->loadMigrationsFrom($dir . '/../../database/migrations');
    }

    /**
     * @return string
     */
    abstract public function getModuleName();

    /**
     * @return string
     */
    abstract public function getDir();

    protected function publishAssets()
    {
        $moduleName = $this->getModuleName();

        $dir = $this->getDir();

        $this->publishes([
            $dir . '/../../resources/views' => config('view.paths')[0] . '/vendor/' . $moduleName,
        ], 'views');

        $this->publishes([
            $dir . '/../../resources/lang' => base_path('resources/lang/vendor/' . $moduleName),
        ], 'lang');

        $this->publishes([
            $dir . '/../../config' => base_path('config'),
        ], 'config');

        $this->publishes([
            $dir . '/../../resources/assets' => resource_path('assets'),
        ], static::PUBLISH_ASSETS);

        $this->publishes([
            $dir . '/../../resources/root' => base_path(),
            $dir . '/../../resources/public' => public_path(),
        ], static::PUBLISH_PUBLIC_ASSETS);
    }

    public function register()
    {
        //Load helpers
        $helpers = File::glob($this->getDir() . '/../../helpers/*.php');
        foreach ($helpers as $helper) {
            require_once $helper;
        }

        //Merge configs
        $configs = $this->splitFilesWithBasename($this->app['files']->glob($this->getDir() . '/../../config/*.php'));

        foreach ($configs as $key => $row) {
            $this->mergeConfigFrom($row, $key);
        }
    }

    /**
     * @param array $files
     * @param string $suffix
     * @return array
     */
    protected function splitFilesWithBasename(array $files, $suffix = '.php'): array
    {
        $result = [];
        foreach ($files as $row) {
            $baseName = basename($row, $suffix);
            $result[$baseName] = $row;
        }
        return $result;
    }
}
