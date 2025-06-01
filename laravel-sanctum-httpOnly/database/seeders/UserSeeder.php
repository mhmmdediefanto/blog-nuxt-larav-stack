<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Siti Nurhaliza', 'email' => 'siti.nurhaliza@example.com'],
            ['name' => 'Budi Santoso', 'email' => 'budi.santoso@example.com'],
            ['name' => 'Rina Oktaviani', 'email' => 'rina.oktaviani@example.com'],
            ['name' => 'Agus Setiawan', 'email' => 'agus.setiawan@example.com'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi.lestari@example.com'],
            ['name' => 'Joko Widodo', 'email' => 'joko.widodo@example.com'],
            ['name' => 'Tini Kartika', 'email' => 'tini.kartika@example.com'],
            ['name' => 'Slamet Riyadi', 'email' => 'slamet.riyadi@example.com'],
            ['name' => 'Nina Marlina', 'email' => 'nina.marlina@example.com'],
            ['name' => 'Rudi Hartono', 'email' => 'rudi.hartono@example.com'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
            ]);
        }
    }
}
