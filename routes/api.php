<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group( function(){
    //Route untuk register user
    Route::post('auth/register', \App\Http\Controllers\Api\Auth\RegisterController::class);
    //Route untuk login user
    Route::post('auth/login', \App\Http\Controllers\Api\Auth\LoginController::class);
     //Route Product
     Route::resource('home', \App\Http\Controllers\Api\HomeController::class)->except(['edit', 'create']);

    //Route yang hanya bisa diakses dengan token
    Route::middleware('auth:sanctum')->group(function () {
    //Route untuk logout
    Route::post('auth/logout', \App\Http\Controllers\Api\Auth\LogoutController::class);
    //Route Categorie
    Route::resource('categorie', \App\Http\Controllers\Api\CategorieController::class)->except(['edit']);
     //Route Product
     Route::resource('product', \App\Http\Controllers\Api\ProductController::class)->except(['edit']);
    });
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
