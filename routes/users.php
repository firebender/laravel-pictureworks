<?php

use Illuminate\Support\Facades\Route;
use FireBender\Laravel\PictureWorks\Http\Controllers\ListUsersController;
use FireBender\Laravel\PictureWorks\Http\Controllers\ViewUserController;

Route::get('users', ListUsersController::class);
Route::get('users/{id}', ViewUserController::class);
