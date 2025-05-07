<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'پاپ', 'slug' => 'pop'],
            ['name' => 'راک', 'slug' => 'rock'],
            ['name' => 'سنتی', 'slug' => 'traditional'],
            ['name' => 'رپ', 'slug' => 'rap'],
            ['name' => 'جاز', 'slug' => 'jazz'],
            ['name' => 'کلاسیک', 'slug' => 'classical'],
            ['name' => 'الکترونیک', 'slug' => 'electronic'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}