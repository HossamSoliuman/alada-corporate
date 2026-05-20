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

class BlogTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['Technology', 'Innovation', 'Strategy', 'Growth', 'Digital', 'Marketing', 'Leadership', 'Sustainability'];

        foreach ($tags as $tag) {
            BlogTag::updateOrCreate(['name' => $tag]);
        }
    }
}
