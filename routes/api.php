<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MovimientoController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [ApiController::class, 'welcome']);

Route::post('auth', [AuthApiController::class, 'authenticate']);

Route::prefix('user')->group(function () {
    Route::post('store', [UserController::class, 'store']);
});

Route::get('movimientos', [MovimientoController::class, 'getMovements']);

Route::middleware('auth:api')->group(function () {
});
