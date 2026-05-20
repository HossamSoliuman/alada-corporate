<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name'=>'Engineering Insights', 'order'=>1],
            ['name'=>'Infrastructure News',  'order'=>2],
            ['name'=>'Digital Engineering',  'order'=>3],
            ['name'=>'Project Spotlights',   'order'=>4],
            ['name'=>'Industry Trends',      'order'=>5],
        ];

        foreach ($categories as $cat) {
            BlogCategory::updateOrCreate(['name' => $cat['name']], array_merge($cat, ['is_active' => true]));
        }
    }
}
