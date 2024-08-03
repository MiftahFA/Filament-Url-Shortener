<?php

namespace Database\Seeders;

use AshAllenDesign\ShortURL\Models\ShortURL;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShortUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //generate 1 short urls
        ShortURL::factory(1)->create(['user_id' => 2,]);
    }
}
