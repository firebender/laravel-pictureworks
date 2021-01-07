<?php

use Illuminate\Support\Facades\Route;
use FireBender\Laravel\PictureWorks\Http\Controllers\ListUsersController;
use FireBender\Laravel\PictureWorks\Http\Controllers\ViewUserController;
use FireBender\Laravel\PictureWorks\Http\Controllers\EditUserController;
use FireBender\Laravel\PictureWorks\Http\Controllers\ModifyUserController;

// Path: /users

Route::get('users/{page?}', ListUsersController::class)->name('list-users');

// Path: /user/id

Route::get('user/{id}', ViewUserController::class)->name('view-user')->middleware('web');

// Path: /user/edit/id

Route::get('user/edit/{id}', EditUserController::class)->name('edit-user')->middleware('web');

// Path: /user/modify

Route::post('user/modify', ModifyUserController::class)->name('modify-user')->middleware('web');
