<?php

use App\Http\Route;

use App\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);

use App\Controllers\NewsController;
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/category/{id}', [NewsController::class, 'category']);
Route::get('/news/get/{id}', [NewsController::class, 'get']);