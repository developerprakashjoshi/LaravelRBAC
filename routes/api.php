<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/register', [UserController::class,'register'] );
Route::post('/login', [UserController::class,'login'] );
Route::get('/me', [UserController::class,'me'] )->middleware('auth:api');
Route::delete('/logout', [UserController::class,'logout'] )->middleware('auth:api');
Route::get('/role', function(){
    dd('hi');
} )->middleware(['auth:api','role:editor']);
