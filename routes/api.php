<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::post('register', [AuthController::class, 'register']); // Register a new user
Route::post('login', [AuthController::class, 'login'])->name('login'); // Login
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']); // Logout

// User Routes (admin-only or authorized)
Route::middleware('auth:sanctum')->get('users', [UserController::class, 'index']); // Get all users
Route::middleware('auth:sanctum')->get('users/{id}', [UserController::class, 'show']); // Get a specific user
Route::middleware('auth:sanctum')->post('users', [UserController::class, 'store']); // Create a new user
Route::middleware('auth:sanctum')->put('users/{id}', [UserController::class, 'update']); // Update a user
Route::middleware('auth:sanctum')->delete('users/{id}', [UserController::class, 'destroy']); // Delete a user

// Category Routes
Route::get('categories', [CategoryController::class, 'index']); // Get all categories
Route::get('categories/{id}', [CategoryController::class, 'show']); // Get a specific category
Route::middleware('auth:sanctum')->post('categories', [CategoryController::class, 'store']); // Create a new category
Route::middleware('auth:sanctum')->put('categories/{id}', [CategoryController::class, 'update']); // Update a category
Route::middleware('auth:sanctum')->delete('categories/{id}', [CategoryController::class, 'destroy']); // Delete a category

// Food Routes
Route::get('foods', [FoodController::class, 'index']); // Get all foods
Route::get('foods/{id}', [FoodController::class, 'show']); // Get a specific food item
Route::middleware('auth:sanctum')->post('foods', [FoodController::class, 'store']); // Create a new food item
Route::middleware('auth:sanctum')->put('foods/{id}', [FoodController::class, 'update']); // Update a food item
Route::middleware('auth:sanctum')->delete('foods/{id}', [FoodController::class, 'destroy']); // Delete a food item

// Order Routes
Route::get('orders', [OrderController::class, 'index']); // Get all orders
Route::get('orders/{id}', [OrderController::class, 'show']); // Get a specific order
Route::middleware('auth:sanctum')->post('orders', [OrderController::class, 'store']); // Create a new order
Route::middleware('auth:sanctum')->put('orders/{id}', [OrderController::class, 'update']); // Update an order
Route::middleware('auth:sanctum')->delete('orders/{id}', [OrderController::class, 'destroy']); // Delete an order

// Get authenticated user (for testing purposes)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
