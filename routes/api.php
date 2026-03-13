<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('show', [ProfileController::class, 'show']);
    Route::put('update', [ProfileController::class, 'update']);
    Route::put('updatePassword', [ProfileController::class, 'updatePassword']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::delete('delete', [ProfileController::class, 'delete']);

});

