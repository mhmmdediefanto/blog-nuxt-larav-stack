<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ediefanto',
            'email' => 'ediefanto778@gmail.com',
            'password' => Hash::make('ediefanto10')
        ]);


        $this->call([
            UserSeeder::class,
            CategoryBlogSeeder::class,
            BlogSeeder::class
        ]);
    }
}
