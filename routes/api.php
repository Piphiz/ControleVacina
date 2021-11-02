<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineController;
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

Route::post('/login', [Controller::class, 'login']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);

Route::get('/vaccine', [VaccineController::class, 'index']);
Route::get('/vaccine/{id}', [VaccineController::class, 'show']);

Route::get('/register', [RegisterController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [Controller::class, 'logout']);

    Route::post('/user/create', [UserController::class, 'store']);
    Route::patch('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    Route::post('/vaccine/create', [VaccineController::class, 'store']);
    Route::patch('/vaccine/{id}', [VaccineController::class, 'update']);
    Route::delete('/vaccine/{id}', [VaccineController::class, 'destroy']);

    Route::post('/register/create', [RegisterController::class, 'register']);
    Route::get('/register/{id}', [RegisterController::class, 'show']);
    Route::delete('/register/{id}', [RegisterController::class, 'destroy']);

});

