<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/**
 * Admin routes
 */

$moduleRoute = 'DummyAlias';

Route::group(['prefix' => $moduleRoute], function (Router $router) {
    Route::get('/', function() {
        page_title()->setTitle('DummyAlias');

        return view('DummyAlias::homepage');
    });
});
