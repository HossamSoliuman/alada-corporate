<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageCard;
use Illuminate\Database\Seeder;

class PageCardSeeder extends Seeder
{
    public function run(): void
    {
        $sets = [
            'why-choose-us' => [
                ['Experts in Building Teams That Deliver', 'Assembling high-performing engineering teams with deep niche expertise in infrastructure and plant engineering.'],
                ['Collaboration Without Barriers', 'Seamless communication, transparent processes, and strong global coordination across every engagement.'],
                ['Beyond Project Delivery', 'Helping partners gain a lasting competitive advantage in their markets, not just completing scopes of work.'],
                ['Innovating Engineering Workflows', 'Refining workflows and applying digital tools for smarter, faster, and more reliable design.'],
                ['Engineering-Driven at the Core', 'Strong technical excellence backed by decades of combined project experience across sectors.'],
                ['Leadership With Ownership', 'Key leaders act as co-owners — ensuring commitment, shared vision, and lasting partnerships.'],
                ['Operating in a True Niche Market', 'Specialised engineering domains that go well beyond common outsourcing areas.'],
                ['Best-in-Class IT Infrastructure', 'Global-grade security, documentation standards, and compliance built into how we work.'],
            ],
            'business-models' => [
                ['Locked-Cost Model', 'For clearly defined scopes where budget certainty is critical — a fixed price agreed upfront, minimizing cost risk and simplifying internal approvals.'],
                ['Pay-As-You-Go Model', 'For flexible or evolving scopes — you only pay for the actual hours and resources used, giving agility without long-term commitment.'],
                ['Virtual Design Center', 'For ongoing, multi-project needs — a cloud-connected, dedicated remote team acting as your extended office, improving speed, knowledge retention, and scalability.'],
                ['Alliance Framework', 'For strategic, long-term partnerships — jointly planned roadmaps, shared KPIs, and joint development that drive higher productivity and continuous improvement.'],
            ],
        ];

        foreach ($sets as $slug => $cards) {
            $page = Page::where('slug', $slug)->first();
            if (! $page) {
                continue;
            }

            foreach ($cards as $i => [$title, $description]) {
                PageCard::updateOrCreate(
                    ['page_id' => $page->id, 'title' => $title],
                    ['description' => $description, 'order' => $i + 1]
                );
            }
        }
    }
}
