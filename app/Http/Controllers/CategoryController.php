<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($name)
    {
        // پیدا کردن دسته‌بندی با نام مورد نظر
        $category = Category::where('name', $name)->firstOrFail();
        
        // نمایش صفحه دسته‌بندی
        return view('category.show', compact('category'));
    }
}