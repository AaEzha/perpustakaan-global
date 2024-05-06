<?php

use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BorrowController;
use App\Http\Controllers\Api\BorrowHistoryController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

Route::get('/', function () {
    return response()->json(['data' => 'Hai']);
});

Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', ProfileController::class);
    Route::get('books', BookController::class);
    Route::get('borrow', BorrowController::class);
    Route::get('borrow-history', BorrowHistoryController::class);
});

Route::fallback(function () {
    return response()->json([
        'status' => Response::HTTP_NOT_FOUND,
        'message' => 'Not found',
        'data' => null,
    ], Response::HTTP_NOT_FOUND)->header('Content-Type', 'application/json');
});
