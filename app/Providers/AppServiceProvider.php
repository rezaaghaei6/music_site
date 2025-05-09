<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // تنظیم حداکثر اندازه فایل آپلودی
        $maxUploadSize = env('MAX_UPLOAD_SIZE', 50000); // پیش‌فرض 50MB
        ini_set('upload_max_filesize', $maxUploadSize . 'K');
        ini_set('post_max_size', $maxUploadSize . 'K');
    }
}