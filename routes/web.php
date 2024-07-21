<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Landing Page
Route::get('/', function () {
    return view('frontend.welcome');
})->name('/');

Route::group(['middleware' => ['auth']], function () {
    // Home
    Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');

        Route::get('/entry', [HomeController::class, 'entry'])->name('entry');

        Route::get('/update', [HomeController::class, 'update'])->name('update');

        Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
    });

    Route::group(['middleware' => ['role:Administrator']], function () {
        Route::group(['prefix' => 'users',  'as' => 'users.'], function () {
            Route::resource('/', UserController::class);
        });
    });
});

require __DIR__ . '/auth.php';
