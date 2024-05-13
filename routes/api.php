<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group(['prefix' => '/v1'], function(){
    Route::get('/welcome', function () {
        return view('welcome');
    });

    //Login page de connexion

    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    //Register page d'inscription

    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
    Route::post('/register', [AuthController::class, 'registerWithImage']);




    // Routes pour les produits
    Route::get('/products', [ProductController::class, 'index'])->name('index.product');
    Route::post('/products', [ProductController::class, 'store'])->name('store.product');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('show.product');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('update.product');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('destroy.product');

    // Routes pour les catégories
    Route::get('/categories', [CategoryController::class, 'index'])->name('index.categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('store.categories');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('show.categories');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('update.categories');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('destroy.categories');

    // Routes pour les utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('index.users');
    Route::post('/users', [UserController::class, 'store'])->name('store.users');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('show.users');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('update.users');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('destroy.users');
});
