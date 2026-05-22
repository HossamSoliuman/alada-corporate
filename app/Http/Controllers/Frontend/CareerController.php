<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;

class CareerController extends Controller
{
    public function index()
    {
        $contactEmail = Setting::get('contact_email');
        $phone = Setting::get('phone');

        $careersPage = Page::where('slug', 'careers')->firstOrFail();

        abort_unless($careersPage->is_published, 404);

        $s = $careersPage->sections ?? [];

        $seo = [
            'title' => 'Careers at Alada | Alada',
            'description' => 'Join Alada and work on impactful projects with global exposure and real career growth.',
            'og_title' => 'Careers at Alada | Alada',
            'og_description' => 'Join Alada and work on impactful projects with global exposure and real career growth.',
        ];

        $hero = [
            'heading' => $s['hero_heading'] ?? 'People. Development. Future.',
            'tagline' => $s['hero_tagline'] ?? 'Work with talented people, collaborate on impactful projects, and grow in a culture built on trust and ownership.',
        ];

        $intro = [
            'label' => $s['intro_label'] ?? 'Join our team',
            'heading' => $s['intro_heading'] ?? 'Powered by People. Driven by Growth.',
            'body_1' => $s['intro_body_1'] ?? 'Alada takes great pride in the success stories of our associates, many of whom have grown from interns to Team Leaders. We provide opportunities that will shape your career through hard work & devotion. We invest deeply in developing you, offering an environment where learning never stops, talent is recognised, and every individual has the support they need to thrive.',
            'body_2' => $s['intro_body_2'] ?? 'For experienced professionals joining Alada, this is a place to elevate your career even further. You\'ll gain access to new leadership opportunities, structured mentorships, advanced technical skill development, and valuable exposure to international clients.',
            'body_3' => $s['intro_body_3'] ?? 'Our collaborative culture reflects our belief that our employees are our greatest asset.',
        ];

        $jobsSection = [
            'heading' => $s['jobs_heading'] ?? 'Freshers. Professionals. Specialists.',
            'subheading' => $s['jobs_subheading'] ?? 'Alada is expanding — join us in shaping the future of infrastructure and industry engineering sectors.',
        ];

        $whySection = [
            'heading' => $s['why_heading'] ?? 'Why work with us?',
            'subheading' => $s['why_subheading'] ?? 'Be part of an environment where your skills are nurtured, your ideas matter, and your work creates real value for clients and communities.',
        ];

        // Gallery images: one URL per line stored in sections
        $galleryRaw = $s['gallery_images'] ?? '';
        $galleryImages = $galleryRaw
            ? array_values(array_filter(array_map('trim', preg_split('/\r?\n/', $galleryRaw))))
            : [];

        if (empty($galleryImages)) {
            $galleryImages = [
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b9a75fb3e304fada24_21_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b9af7401cb78c4dbe6_1_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b96ac037e60cf1e4a7_19_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b9e75ceac342768125_22_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b950cb168969519963_20_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b9133ccfcccb622619_7_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b9f89fe7e95cbd6a0f_3_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b922e16a91e7fbf30c_4_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b9774087b30a98139f_18_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b9696a0026f2837566_23_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b997e041883fbd7689_5_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3b999f12dc0f0dcc63f_2_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3ba528de40a032bf18f_6_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bbd5f8f401bc02856e_13_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bbd0543a087b61541b_11_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bbb212060a9d90010b_14_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bbfe5e840bfa3abe8b_8_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bb7a04adabf4d67ab7_10_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bb09b8a4836c163b76_15_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bbd0543a087b615449_9_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bb8944c6203f6775e9_12_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bcc98c3e247644d5b1_17_converted.avif',
                'https://cdn.prod.website-files.com/696659aa8fa6ba842420cbf1/6994a3bc367b4c811f42664e_16_converted.avif',
            ];
        }

        // Why Alada cards
        $whyCardsRaw = $s['why_cards'] ?? '';
        $whyCards = ($whyCardsRaw && json_validate($whyCardsRaw))
            ? json_decode($whyCardsRaw, true)
            : null;

        if (! $whyCards) {
            $whyCards = [
                ['icon' => 'https://cdn.prod.website-files.com/696b6016072596dc6f3b8af3/69bac3ed2c26baeb54b25afd_Innovation-Driven%20Workflows.svg', 'title' => 'Innovation-Driven Workflows', 'body' => 'We embed advanced digital methodologies across every discipline — from parametric design and BIM to digital twin delivery — ensuring every project benefits from modern engineering thinking.'],
                ['icon' => 'https://cdn.prod.website-files.com/696b6016072596dc6f3b8af3/69bac3fe0ccfc93113c421f8__Career%20Growth%20%26%20Advancement.svg', 'title' => 'Career Growth & Advancement', 'body' => 'Whether you\'re a graduate or a seasoned professional, Alada offers structured growth paths, technical skill development, and clear leadership opportunities at every level.'],
                ['icon' => 'https://cdn.prod.website-files.com/696b6016072596dc6f3b8af3/69bac408ea1094daabd358bb_Stable%20%26%20Growing%20Organization.svg', 'title' => 'Stable & Growing Organization', 'body' => 'Growth at Alada is guided, not left to chance. Our experienced leaders invest in every team member through structured mentorship, continuous feedback, and hands-on learning.'],
                ['icon' => 'https://cdn.prod.website-files.com/696b6016072596dc6f3b8af3/69bac4132902d1df767db08b_International%20Project%20Exposure.svg', 'title' => 'International Project Exposure', 'body' => 'Work on landmark infrastructure projects across the Americas, Europe, Middle East, Asia, and Oceania — gaining cross-cultural experience that accelerates your professional growth.'],
                ['icon' => 'https://cdn.prod.website-files.com/696b6016072596dc6f3b8af3/69bac41f816a6ebfcb506bdc_Mentorship%20Culture.svg', 'title' => 'Mentorship Culture', 'body' => 'Every team member is paired with experienced engineers and project leaders who invest in your development through regular feedback, guidance, and career-shaping opportunities.'],
                ['icon' => 'https://cdn.prod.website-files.com/696b6016072596dc6f3b8af3/69bac42a179b085b4cc57ab4_Employee-Centric%20Culture.svg', 'title' => 'Employee-Centric Culture', 'body' => 'We believe great work happens when people feel valued. Our flexible approach supports personal well-being, family time, and professional excellence — helping you stay energised and fulfilled.'],
            ];
        }

        // Job listings
        $jobsRaw = $s['jobs'] ?? '';
        $jobs = ($jobsRaw && json_validate($jobsRaw))
            ? json_decode($jobsRaw, true)
            : null;

        if (! $jobs) {
            $jobs = [
                ['id' => 1, 'title' => 'Senior Civil Engineer – Transportation Infrastructure', 'category' => 'transportation', 'label' => 'Transportation', 'location' => 'USA / Remote', 'type' => 'Full-time', 'description' => 'Lead the design and delivery of road, bridge, and highway projects to U.S. standards. You will manage multi-discipline coordination and mentor junior engineers.'],
                ['id' => 2, 'title' => 'BIM Coordinator – Digital Twin & Parametric Modeling', 'category' => 'digital', 'label' => 'Digital Twin & BIM', 'location' => 'India Hub / Remote', 'type' => 'Full-time', 'description' => 'Develop and manage BIM models, coordinate parametric workflows, and deliver digital twin outputs across infrastructure and industrial projects.'],
                ['id' => 3, 'title' => 'Land Development Engineer', 'category' => 'engineering', 'label' => 'Engineering & Design', 'location' => 'USA / Middle East', 'type' => 'Full-time', 'description' => 'Design site grading, drainage systems, and civil infrastructure layouts for residential, commercial, and mixed-use developments across global markets.'],
                ['id' => 4, 'title' => 'Industrial Piping & Process Engineer', 'category' => 'industrial', 'label' => 'Industrial & Piping', 'location' => 'Middle East / India', 'type' => 'Full-time', 'description' => 'Engineer process piping systems, plant layouts, and industrial facility infrastructure for large-scale oil, gas, and manufacturing projects.'],
                ['id' => 5, 'title' => 'Infrastructure Project Manager', 'category' => 'management', 'label' => 'Project Management', 'location' => 'USA / UK / Australia', 'type' => 'Full-time', 'description' => 'Own end-to-end project delivery from scope definition through construction supervision, managing budgets, schedules, and multi-discipline teams.'],
                ['id' => 6, 'title' => 'Structural Engineer – Civil Infrastructure', 'category' => 'engineering', 'label' => 'Engineering & Design', 'location' => 'Remote / Global', 'type' => 'Full-time', 'description' => 'Analyse and design structural elements for bridges, retaining walls, culverts, and large civil infrastructure across international project environments.'],
                ['id' => 7, 'title' => 'GIS & Survey Specialist', 'category' => 'engineering', 'label' => 'Engineering & Design', 'location' => 'India Hub / Remote', 'type' => 'Full-time', 'description' => 'Conduct GIS analysis, topographic data processing, and survey coordination to support feasibility studies and detailed engineering across all service lines.'],
                ['id' => 8, 'title' => 'Digital Transformation Lead – Infrastructure', 'category' => 'digital', 'label' => 'Digital Twin & BIM', 'location' => 'USA / Remote', 'type' => 'Full-time', 'description' => 'Drive adoption of digital delivery methodologies including parametric design, digital twins, and data-driven asset management across Alada project portfolios.'],
            ];
        }

        foreach ($jobs as &$job) {
            $job['applyUrl'] = route('contact');
        }
        unset($job);

        $categories = [
            'all' => 'All Positions',
            'engineering' => 'Engineering & Design',
            'transportation' => 'Transportation',
            'digital' => 'Digital Twin & BIM',
            'industrial' => 'Industrial & Piping',
            'management' => 'Project Management',
        ];

        return view('frontend.career', compact(
            'jobs', 'categories', 'contactEmail', 'phone', 'seo',
            'hero', 'intro', 'jobsSection', 'whySection', 'galleryImages', 'whyCards'
        ));
    }
}
