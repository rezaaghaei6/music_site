<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // نمایش صفحه اصلی
    public function index()
    {
        $categories = [
            ['name' => 'ترند اینستاگرام'],
            ['name' => 'سنتی'],
            ['name' => 'پاپ'],
            ['name' => 'ترند جهانی'],
            ['name' => 'موسیقی آرامش‌بخش'],
        ];

        return view('home.index', compact('categories'));
    }

    // نمایش دسته‌بندی‌های موسیقی
    public function category($name)
    {
        return view('home.category', compact('name'));
    }
}