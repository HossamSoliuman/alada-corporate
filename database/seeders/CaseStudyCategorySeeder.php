<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\CaseStudyCategory;
use App\Models\Industry;
use App\Models\Page;
use App\Models\Service;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class CaseStudyCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Digital Transformation', 'order' => 1],
            ['name' => 'Cloud Migration',         'order' => 2],
            ['name' => 'Process Automation',      'order' => 3],
            ['name' => 'System Integration',      'order' => 4],
        ];

        foreach ($categories as $cat) {
            CaseStudyCategory::updateOrCreate(['name' => $cat['name']], array_merge($cat, ['is_active' => true]));
        }
    }
}
