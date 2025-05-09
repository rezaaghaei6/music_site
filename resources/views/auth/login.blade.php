@extends('layouts.app')

@section('title', 'ورود به حساب کاربری')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold gradient-text">{{ config('app.name') }}</h1>
            <h2 class="mt-6 text-2xl font-bold text-gray-900">ورود به حساب کاربری</h2>
            <p class="mt-2 text-sm text-gray-600">
                حساب کاربری ندارید؟
                <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-500">ثبت‌نام کنید</a>
            </p>
        </div>
        
        @if ($errors->any())
            <div class="bg-red-100 border-r-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <ul class="list-disc mr-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form class="space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">ایمیل</label>
                <div class="mt-1">
                    <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                </div>
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">رمز عبور</label>
                <div class="mt-1">
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                </div>
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" 
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                    <label for="remember_me" class="mr-2 block text-sm text-gray-900">
                        مرا به خاطر بسپار
                    </label>
                </div>
                
                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="text-primary-600 hover:text-primary-500">
                        رمز عبور را فراموش کرده‌اید؟
                    </a>
                </div>
            </div>
            
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    ورود
                </button>
            </div>
        </form>
        
        <div class="mt-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">یا ورود با</span>
                </div>
            </div>
            
            <div class="mt-6 grid grid-cols-2 gap-3">
                <div>
                    <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fab fa-google text-red-500"></i>
                        <span class="mr-2">گوگل</span>
                    </a>
                </div>
                <div>
                    <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                        <i class="fab fa-telegram text-blue-500"></i>
                        <span class="mr-2">تلگرام</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection