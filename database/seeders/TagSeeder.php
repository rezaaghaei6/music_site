<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'لاراول', 'slug' => 'laravel'],
            ['name' => 'پی‌اچ‌پی', 'slug' => 'php'],
            ['name' => 'جاوااسکریپت', 'slug' => 'javascript'],
            ['name' => 'ری‌اکت', 'slug' => 'react'],
            ['name' => 'ویو', 'slug' => 'vue'],
            ['name' => 'تیلویند', 'slug' => 'tailwind'],
            ['name' => 'هوش مصنوعی', 'slug' => 'ai'],
            ['name' => 'یادگیری ماشین', 'slug' => 'machine-learning'],
            ['name' => 'دیتابیس', 'slug' => 'database'],
            ['name' => 'لینوکس', 'slug' => 'linux'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
