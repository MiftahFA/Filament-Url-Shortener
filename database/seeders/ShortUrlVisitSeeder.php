<?php

namespace Database\Seeders;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Database\Factories\MyShortUrlVisitFactory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShortUrlVisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //genereate 100 short urls visit
        $faker = Factory::create();
        //iterate 100 times
        for ($i = 0; $i < 1000; $i++) {
            $this->createShortUrlVisit($faker);
        }
    }

    public function createShortUrlVisit($faker)
    {
        $thisYear = $faker->dateTimeThisYear();
        return DB::table('short_url_visits')->insert([
            'short_url_id' => 1,
            'ip_address' => $faker->ipv4(),
            'operating_system' => $faker->randomElement([
                'OS X',
                'iOS',
                'Android',
                'null',
            ]),
            'operating_system_version' => $faker->randomFloat(8, 20),
            'browser' => $faker->randomElement([
                'Firefox',
                'Safari',
                'Chrome',
                'Googlebot',
            ]),
            'browser_version' => $faker->randomFloat(8, 20),
            'device_type' => $faker->randomElement([
                'desktop',
                'mobile',
                'tablet',
                'robot',
            ]),
            'visited_at' => $thisYear,
            'referer_url' => $faker->url(),
            'created_at' => $thisYear,
            'updated_at' => $thisYear,
        ]);
    }
}
