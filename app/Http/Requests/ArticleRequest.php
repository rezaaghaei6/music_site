// app/Http/Requests/ArticleRequest.php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'status' => 'required|in:published,draft',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'عنوان',
            'excerpt' => 'خلاصه',
            'content' => 'محتوا',
            'image' => 'تصویر',
            'status' => 'وضعیت',
            'category_id' => 'دسته‌بندی',
            'tags' => 'برچسب‌ها',
            'meta_title' => 'عنوان متا',
            'meta_description' => 'توضیحات متا',
            'published_at' => 'تاریخ انتشار',
        ];
    }
}
