<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@nurfachmi.com',
            'title' => User::TITLE_ADMIN,
        ]);

        User::factory()->create([
            'name' => 'Anggota',
            'email' => 'anggota@nurfachmi.com',
            'title' => User::TITLE_ANGGOTA,
        ]);
    }
}
