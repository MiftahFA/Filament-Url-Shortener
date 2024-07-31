<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin' => '1'
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'is_admin' => '0'
        ]);
    }
}
