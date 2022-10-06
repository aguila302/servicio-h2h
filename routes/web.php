<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
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

Route::name('web.')->group(function () {

    Route::get('/login', [LoginController::class, 'getView'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

    Route::middleware(['auth'])->group(function () {

        Route::get('/', [HomeController::class, 'getHome'])->name('home');

    });

});


