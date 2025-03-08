<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/show', [BlogController::class, 'show']);
Route::post('/insert', [BlogController::class, 'store']);
Route::post('/update/{id}', [BlogController::class, 'update']);
Route::delete('/delete/{id}', [BlogController::class, 'destroy']);

