@extends('layouts.app')

@section('title', 'صفحه مورد نظر یافت نشد')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full text-center">
        <div class="text-9xl font-bold text-primary-300 mb-4">404</div>
        <h1 class="text-3xl font-bold text-gray-900 mb-4">صفحه مورد نظر یافت نشد</h1>
        <p class="text-gray-600 mb-8">متأسفانه صفحه‌ای که به دنبال آن هستید وجود ندارد یا به آدرس دیگری منتقل شده است.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="{{ route('home') }}" class="bg-primary-600 text-white px-6 py-3 rounded-md hover:bg-primary-700 transition-colors">
                بازگشت به صفحه اصلی
            </a>
            <button onclick="window.history.back()" class="bg-white text-gray-700 border border-gray-300 px-6 py-3 rounded-md hover:bg-gray-50 transition-colors">
                بازگشت به صفحه قبل
            </button>
        </div>
        
        <div class="mt-12">
            <p class="text-gray-500 text-sm">
                اگر فکر می‌کنید این یک اشتباه است، لطفاً با پشتیبانی تماس بگیرید.
            </p>
        </div>
    </div>
</div>
@endsection