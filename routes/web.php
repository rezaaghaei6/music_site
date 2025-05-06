<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// صفحه اصلی
Route::get('/', [HomeController::class, 'index'])->name('home');

// دسته‌بندی‌های موسیقی
Route::get('/category/{name}', [HomeController::class, 'category'])->name('category');

// صفحه تماس با ما
Route::get('/contact', function() {
    return view('home.contact');
})->name('contact');

// صفحه سوالات متداول
Route::get('/faq', function() {
    return view('home.faq');
})->name('faq');

// صفحه قوانین و مقررات
Route::get('/terms', function() {
    return view('home.terms');
})->name('terms');

// صفحه حریم خصوصی
Route::get('/privacy', function() {
    return view('home.privacy');
})->name('privacy');