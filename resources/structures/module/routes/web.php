<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */

$moduleRoute = 'DummyAlias';

Route::group(['prefix' => $moduleRoute], function (Router $router) {
    Route::get('/', function() {
        return "I'm  /DummyAlias...!";
    });
});
