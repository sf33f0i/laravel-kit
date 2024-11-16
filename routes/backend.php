<?php

use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\SiteController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::name('backend.')
    ->middleware(['can:use-backend-panel', 'auth'])
    ->group(function () {
        Route::get('/', [SiteController::class, 'index'])
            ->name('/');

        Route::middleware('can:use-crud')->group(function () {
            Route::resource('user', UserController::class);
            Route::resource('page', PageController::class);
        });
    });
