<?php

namespace Database\Seeders;

use Database\Factories\BlogFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogFactory::new()->count(1000)->create();
    }
}
