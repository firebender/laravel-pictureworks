<?php

use Illuminate\Support\Facades\Route;
use FireBender\Laravel\PictureWorks\Http\Controllers\ListUsersController;
use FireBender\Laravel\PictureWorks\Http\Controllers\ViewUserController;

// Path: /users

Route::get('users', ListUsersController::class)->name('list-users');

// Path: /users/id

Route::get('users/{id}', ViewUserController::class)->name('view-user');
