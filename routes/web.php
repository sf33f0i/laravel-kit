<?php

declare(strict_types=1);

use App\Http\Controllers\GeoDataController;
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

Route::get('/', [GeoDataController::class, 'index'])->name('/');
Route::post('/store', [GeoDataController::class, 'store'])->name('geodata.store');
Route::delete('/delete/{id}', [GeoDataController::class, 'delete'])->name('geodata.delete');

