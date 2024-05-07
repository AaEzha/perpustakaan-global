<?php

use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\BorrowBookController;
use App\Http\Controllers\Web\BorrowController;
use App\Http\Controllers\Web\BorrowHistoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UserPasswordController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('home');

    Route::middleware('can:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('user-password', UserPasswordController::class)->only(['edit', 'update']);

        Route::resource('books', BookController::class);

        Route::resource('borrows', BorrowController::class)->except(['edit', 'update', 'show']);
        Route::resource('borrow-books', BorrowBookController::class)->only(['show', 'update']);
        Route::get('borrow-history', BorrowHistoryController::class)->name('borrow-history');
    });
});
