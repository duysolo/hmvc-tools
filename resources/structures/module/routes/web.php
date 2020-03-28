<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */

$moduleRoute = 'DummyAlias';

Route::group(['prefix' => $moduleRoute], function (Router $router) {
    /**
     *
     * Put some route here
     *
     */
});
