<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', [UserController::class, 'index']);
Route::post('/user/create', [UserController::class, 'store']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::patch('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::get('/vaccine', [VaccineController::class, 'index']);
Route::post('/vaccine/create', [VaccineController::class, 'store']);
Route::get('/vaccine/{id}', [VaccineController::class, 'show']);
Route::patch('/vaccine/{id}', [VaccineController::class, 'update']);
Route::delete('/vaccine/{id}', [VaccineController::class, 'destroy']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register/create', [RegisterController::class, 'register']);
Route::get('/register/{id}', [RegisterController::class, 'show']);
Route::delete('/register/{id}', [RegisterController::class, 'destroy']);
