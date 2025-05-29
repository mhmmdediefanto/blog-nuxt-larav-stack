<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryBlogController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::prefix('api')->group(function () {
        Route::get('/user', function () {
            return Auth::user();
        })->middleware('auth:sanctum');

        Route::post('/auth/login', [AuthController::class, 'authenticate']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);

        Route::middleware(['auth:sanctum'])->prefix('dashboard')->group(function () {
            Route::get('/categories', [CategoryBlogController::class, 'getAllCategory'])->name('categories');
            Route::post('/categories', [CategoryBlogController::class, 'createCategory'])->name('categories.create');
            Route::put('/categories/{id}', [CategoryBlogController::class, 'editCategory'])->name('categories.edit');
            Route::delete('/categories/delete/{id}', [CategoryBlogController::class, 'deleteCategory'])->name('categories.delete');


            Route::get('/blogs', [BlogController::class, 'getAllBlog'])->name('blogs');
            Route::post('/blogs', [BlogController::class, 'createBlog'])->name('blogs.create');
            Route::put('/blogs/{id}', [BlogController::class, 'updateBlog'])->name('blogs.update');
            Route::get('/blogs/detail/{id}', [BlogController::class, 'showDetail'])->name('blogs.detail');
        });
    });
});
