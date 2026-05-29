<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // The former "about" page is now the Company Overview page.
        Page::where('slug', 'about')->update(['slug' => 'company-overview']);

        $pages = [
            // [
            //     'slug' => 'home',
            //     'title' => 'Global Engineering & Infrastructure Solutions',
            //     'subtitle' => 'Growing With Time',
            //     'is_published' => true,
            //     'published_at' => now(),
            // ],
            [
                'slug' => 'company-overview',
                'title' => 'About Alada',
                'subtitle' => 'A globally integrated, multi-disciplinary engineering consultancy established in the United States.',
                'content' => '<p>Alada is a globally integrated, multi-disciplinary engineering and infrastructure consultancy, established in the United States, with a strategically developed India-based delivery model supported by fully owned and operational engineering offices.</p>',
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'slug' => 'our-team',
                'title' => 'Our Team',
                'subtitle' => 'The people behind our engineering excellence — a globally distributed team of specialists.',
                'sections' => [
                    'intro_label' => 'People First',
                    'intro_heading' => 'A Team Built for Complex Engineering',
                    'intro_body' => "Our strength lies in our people. We bring together experienced engineers, designers, and project specialists across multiple disciplines and geographies, working as one integrated team.\n\nEvery member shares a commitment to technical excellence, collaboration, and delivering reliable solutions for our partners worldwide.",
                ],
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'slug' => 'why-choose-us',
                'title' => 'Why Choose Us',
                'subtitle' => 'From planning to delivery, we bring accuracy, accountability, and proven experience to every project.',
                'sections' => [
                    'intro_label' => 'Expertise. Ownership. Reliability.',
                    'intro_heading' => 'On Time, On Budget, Driven by Technical Ownership',
                    'intro_body' => "Clients choose us for dependable delivery driven by genuine technical ownership. We bring engineering excellence across infrastructure and industry sectors, backed by strong team retention and proven collaboration frameworks.\n\nOur focus is on long-term competitiveness — supported by secure, global-grade IT infrastructure and a culture of accountability at every level.",
                ],
                'is_published' => true,
                'published_at' => now(),
            ],
            [
                'slug' => 'business-models',
                'title' => 'Business Models',
                'subtitle' => 'From fixed scope to strategic partnership, our models adapt to your needs — every option delivers efficiency, security, and scalability by design.',
                'sections' => [
                    'intro_label' => 'Value. Models. Results.',
                    'intro_heading' => 'Engagement Models That Adapt to You',
                    'intro_body' => "Each engagement model provides flexibility — adapting to scope clarity, risk allocation, integration depth, and responsibility levels.\n\nWe emphasise transparency, predictability, and true value for money, supporting both immediate success and long-term competitive advantage.",
                ],
                'is_published' => true,
                'published_at' => now(),
            ],
            // ['slug' => 'privacy-policy', 'title' => 'Privacy Policy', 'subtitle' => 'How we handle your data', 'is_published' => true, 'published_at' => now()],
            // ['slug' => 'terms-conditions', 'title' => 'Terms & Conditions', 'subtitle' => 'Our terms of service', 'is_published' => true, 'published_at' => now()],
            // ['slug' => 'careers', 'title' => 'Careers at Alada', 'subtitle' => 'Join our global engineering team', 'is_published' => true, 'published_at' => now()],
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
