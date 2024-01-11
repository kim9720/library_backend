<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoriteController;


// public route
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');

// protected Route
Route::middleware(['auth:sanctum'])->group(function () {

    
});

// user route
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/userscount', [UserController::class,'getNumberOfUsers']);

// book route
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
Route::get('/books/{id}/image', [BookController::class, 'getImage']);
Route::get('/bookscount', [BookController::class, 'getNumberOfBooks']);


// Route for listing all favorites
Route::get('/favorites', [FavoriteController::class, 'index']);

// Route for showing a specific favorite
Route::get('/favorites/{id}', [FavoriteController::class, 'show']);

// Route for creating a new favorite
Route::post('/favorites', [FavoriteController::class, 'store']);

// Route for deleting a favorite
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);
