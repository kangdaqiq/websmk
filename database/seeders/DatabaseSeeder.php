<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat admin user (password: Admin@1234 — segera ganti setelah login!)
        User::firstOrCreate(
            ['email' => 'admin@websmk.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin@1234'),
                'email_verified_at' => now(),
            ]
        );
    }
}
