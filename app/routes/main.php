<?php

use App\Http\Route;

use App\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);

use App\Controllers\BlogController;
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/category/{id}', [BlogController::class, 'category']);
Route::get('/blog/post/{id}', [BlogController::class, 'get']);