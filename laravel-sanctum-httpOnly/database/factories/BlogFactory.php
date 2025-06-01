<?php

namespace Database\Factories;

use App\Models\CategoryBlog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        return [
            'user_id' => User::factory(),
            'category_blog_id' => rand(1, CategoryBlog::count()),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5), // pastikan slug unik
            'excerpt' => $this->faker->text(100),
            'content' => $this->faker->paragraphs(5, true),
            'image' => null, // diset null sesuai permintaan
        ];
    }
}
