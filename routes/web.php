<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SearchController;

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

        Route::get('/update', [DataController::class, 'edit'])->name('update.edit');
        Route::put('/update/{id}', [DataController::class, 'update'])->name('update.update');

        Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
    });
    Route::post('/home/submit', [DataController::class, 'submit'])->name('submit'); 
    Route::get('/home/get-perihal-by-nde', [DataController::class, 'getPerihalByNde'])->name('getPerihalByNde');   
    Route::get('/home/get-perihal-by-nde-input', [DataController::class, 'getPerihalByNdeInput'])->name('getPerihalByNdeInput');

    Route::get('/search', [SearchController::class, 'search'])->name('search');


    Route::group(['middleware' => ['role:Administrator']], function () {
        Route::group(['prefix' => 'users',  'as' => 'users.'], function () {
            Route::resource('/', UserController::class);
        });
    });
});


require __DIR__ . '/auth.php';
