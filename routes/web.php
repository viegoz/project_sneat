<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\SearchController;

/// Landing Page
Route::get('/', function () {
    return view('frontend.welcome');
})->name('/');

Route::group(['middleware' => ['auth']], function () {
    // Home
    Route::group(['prefix' => 'home', 'as' => 'home.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/entry', [EntryController::class, 'entry'])->name('entry'); // Updated to EntryController
        Route::get('/update', [HomeController::class, 'update'])->name('update');
        Route::get('/monitoring', [HomeController::class, 'monitoring'])->name('monitoring');
        Route::get('/get-kantor-by-regional/{regional}', [EntryController::class, 'getKantorByRegional']);
        Route::get('/get-kantor-details/{nama_kantor}', [EntryController::class, 'getKantorDetails']);
        Route::post('/entry', [EntryController::class, 'store'])->name('home.entry'); // Updated to post method
        Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring');
        Route::get('/update', [DataController::class, 'edit'])->name('update.edit');
        Route::put('/update/{id}', [DataController::class, 'update'])->name('update.update');
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