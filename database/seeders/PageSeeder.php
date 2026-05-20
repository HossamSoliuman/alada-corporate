<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug'         => 'home',
                'title'        => 'Global Engineering & Infrastructure Solutions',
                'subtitle'     => 'Growing With Time',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'slug'         => 'about',
                'title'        => 'About Alada',
                'subtitle'     => 'A globally integrated, multi-disciplinary engineering consultancy established in the United States.',
                'content'      => '<p>Alada is a globally integrated, multi-disciplinary engineering and infrastructure consultancy, established in the United States, with a strategically developed India-based delivery model supported by fully owned and operational engineering offices.</p>',
                'is_published' => true,
                'published_at' => now(),
            ],
            ['slug'=>'privacy-policy',  'title'=>'Privacy Policy',   'subtitle'=>'How we handle your data',          'is_published'=>true,'published_at'=>now()],
            ['slug'=>'terms-conditions','title'=>'Terms & Conditions','subtitle'=>'Our terms of service',             'is_published'=>true,'published_at'=>now()],
            ['slug'=>'careers',         'title'=>'Careers at Alada', 'subtitle'=>'Join our global engineering team', 'is_published'=>true,'published_at'=>now()],
        ];

        foreach ($pages as $page) {
            $p = Page::updateOrCreate(['slug' => $page['slug']], $page);
            SeoMeta::updateOrCreate(
                ['seoable_type' => Page::class, 'seoable_id' => $p->id],
                ['meta_title' => $page['title'].' | Alada', 'meta_description' => $page['subtitle'] ?? '', 'robots' => 'index,follow']
            );
        }
    }
}
