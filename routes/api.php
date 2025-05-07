<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// مسیرهای API عمومی
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article:slug}', [ArticleController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

Route::get('/tags', [TagController::class, 'index']);
Route::get('/tags/{tag:slug}', [TagController::class, 'show']);

Route::get('/articles/{article:slug}/comments', [CommentController::class, 'index']);
Route::post('/articles/{article:slug}/comments', [CommentController::class, 'store']);

// مسیرهای API محافظت شده
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
