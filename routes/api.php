<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('users', UserController::class);
Route::apiResource('teams', \App\Http\Controllers\TeamController::class);
Route::post('/teams/seed', [TeamController::class, 'storeTen']);
Route::apiResource('tries', \App\Http\Controllers\TriesController::class);

//Ruta ejercicio en clase 13 de noviembre
Route::post('/tries/seed', [\App\Http\Controllers\TriesController::class, 'storeTen']);
Route::middleware(['filter.ip'])->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'OK']);
    });
});
