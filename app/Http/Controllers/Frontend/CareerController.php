<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
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
        ];

        $whyCards = [
            ['title' => 'Innovation-Driven Workflows', 'body' => 'We embed advanced digital methodologies across every discipline — from parametric design and BIM to digital twin delivery — ensuring every project benefits from modern engineering thinking.'],
            ['title' => 'Career Growth & Advancement', 'body' => 'Whether you\'re a graduate or a seasoned professional, Alada offers structured growth paths, technical skill development, and clear leadership opportunities at every level.'],
            ['title' => 'Stable & Growing Organization', 'body' => 'Growth at Alada is guided, not left to chance. Our experienced leaders invest in every team member through structured mentorship, continuous feedback, and hands-on learning.'],
            ['title' => 'International Project Exposure', 'body' => 'Work on landmark infrastructure projects across the Americas, Europe, Middle East, Asia, and Oceania — gaining cross-cultural experience that accelerates your professional growth.'],
            ['title' => 'Mentorship Culture', 'body' => 'Every team member is paired with experienced engineers and project leaders who invest in your development through regular feedback, guidance, and career-shaping opportunities.'],
            ['title' => 'Employee-Centric Culture', 'body' => 'We believe great work happens when people feel valued. Our flexible approach supports personal well-being, family time, and professional excellence — helping you stay energised and fulfilled.'],
        ];

        $jobs = JobListing::active()->get();

        return view('frontend.career', compact(
            'jobs', 'contactEmail', 'phone', 'seo',
            'hero', 'intro', 'jobsSection', 'whySection', 'galleryImages', 'whyCards'
        ));
    }
}
