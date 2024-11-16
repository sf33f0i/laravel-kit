<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(env('ADMIN_DOMAIN'))
    ->group(function () {
        require __DIR__ . '/auth.php';
        require __DIR__ . '/backend.php';
    });

Route::get('/', [SiteController::class, 'index'])->name('/');

