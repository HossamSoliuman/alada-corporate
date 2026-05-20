<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingSeeder::class,
            PageSeeder::class,
            BlogCategorySeeder::class,
            BlogTagSeeder::class,
            IndustrySeeder::class,
            ServiceSeeder::class,
            CaseStudyCategorySeeder::class,
        ]);
    }
}
