<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'تکنولوژی',
                'slug' => 'technology',
                'description' => 'مقالات مرتبط با تکنولوژی و فناوری',
            ],
            [
                'name' => 'برنامه‌نویسی',
                'slug' => 'programming',
                'description' => 'مقالات مرتبط با برنامه‌نویسی و توسعه نرم‌افزار',
            ],
            [
                'name' => 'طراحی وب',
                'slug' => 'web-design',
                'description' => 'مقالات مرتبط با طراحی وب و رابط کاربری',
            ],
            [
                'name' => 'هوش مصنوعی',
                'slug' => 'artificial-intelligence',
                'description' => 'مقالات مرتبط با هوش مصنوعی و یادگیری ماشین',
            ],
            [
                'name' => 'سبک زندگی',
                'slug' => 'lifestyle',
                'description' => 'مقالات مرتبط با سبک زندگی و سلامتی',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
