<?php

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UserPasswordController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::resource('users', UserController::class)->middleware('can:admin');
    Route::resource('user-password', UserPasswordController::class)->middleware('can:admin')->only(['edit', 'update']);

    Route::resource('books', BookController::class)->middleware('can:admin');
});
