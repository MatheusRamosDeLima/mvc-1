<?php

use App\Http\Route;

use App\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);