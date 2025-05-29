<?php

namespace Database\Seeders;

use App\Models\CategoryBlog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pemrograman',
                'slug' => 'pemrograman',
            ],
            [
                'name' => 'Desain',
                'slug' => 'desain',
            ],
            [
                'name' => 'Teknologi',
                'slug' => 'teknologi',
            ],
            [
                'name' => 'Hiburan',
                'slug' => 'hiburan',
            ],
            [
                'name' => 'Kesehatan',
                'slug' => 'kesehatan',
            ],
            [
                'name' => 'Olahraga',
                'slug' => 'olahraga',
            ],
            [
                'name' => 'Kuliner',
                'slug' => 'kuliner',
            ]
        ];


        foreach ($categories as $category) {
            CategoryBlog::create($category);
        }
    }
}
