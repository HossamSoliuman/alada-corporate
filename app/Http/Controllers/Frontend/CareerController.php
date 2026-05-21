<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index()
    {
        $categories = [
            'all' => 'All Positions',
            'engineering' => 'Engineering & Design',
            'transportation' => 'Transportation',
            'digital' => 'Digital Twin & BIM',
            'industrial' => 'Industrial & Piping',
            'management' => 'Project Management',
        ];

        $jobs = [
            [
                'id' => 1,
                'title' => 'Senior Civil Engineer – Transportation Infrastructure',
                'category' => 'transportation',
                'label' => 'Transportation',
                'location' => 'USA / Remote',
                'type' => 'Full-time',
                'description' => 'Lead the design and delivery of road, bridge, and highway projects to U.S. standards. You will manage multi-discipline coordination and mentor junior engineers.',
                'image' => 'https://images.pexels.com/photos/210182/pexels-photo-210182.jpeg?auto=compress&cs=tinysrgb&w=800',
                'applyUrl' => route('contact'),
            ],
            [
                'id' => 2,
                'title' => 'BIM Coordinator – Digital Twin & Parametric Modeling',
                'category' => 'digital',
                'label' => 'Digital Twin & BIM',
                'location' => 'India Hub / Remote',
                'type' => 'Full-time',
                'description' => 'Develop and manage BIM models, coordinate parametric workflows, and deliver digital twin outputs across infrastructure and industrial projects.',
                'image' => 'https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&cs=tinysrgb&w=800',
                'applyUrl' => route('contact'),
            ],
            [
                'id' => 3,
                'title' => 'Land Development Engineer',
                'category' => 'engineering',
                'label' => 'Engineering & Design',
                'location' => 'USA / Middle East',
                'type' => 'Full-time',
                'description' => 'Design site grading, drainage systems, and civil infrastructure layouts for residential, commercial, and mixed-use developments across global markets.',
                'image' => 'https://images.pexels.com/photos/2097540/pexels-photo-2097540.jpeg?auto=compress&cs=tinysrgb&w=800',
                'applyUrl' => route('contact'),
            ],
            [
                'id' => 4,
                'title' => 'Industrial Piping & Process Engineer',
                'category' => 'industrial',
                'label' => 'Industrial & Piping',
                'location' => 'Middle East / India',
                'type' => 'Full-time',
                'description' => 'Engineer process piping systems, plant layouts, and industrial facility infrastructure for large-scale oil, gas, and manufacturing projects.',
                'image' => 'https://images.pexels.com/photos/1108101/pexels-photo-1108101.jpeg?auto=compress&cs=tinysrgb&w=800',
                'applyUrl' => route('contact'),
            ],
            [
                'id' => 5,
                'title' => 'Infrastructure Project Manager',
                'category' => 'management',
                'label' => 'Project Management',
                'location' => 'USA / UK / Australia',
                'type' => 'Full-time',
                'description' => 'Own end-to-end project delivery from scope definition through construction supervision, managing budgets, schedules, and multi-discipline teams.',
                'image' => 'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800',
                'applyUrl' => route('contact'),
            ],
            [
                'id' => 6,
                'title' => 'Structural Engineer – Civil Infrastructure',
                'category' => 'engineering',
                'label' => 'Engineering & Design',
                'location' => 'Remote / Global',
                'type' => 'Full-time',
                'description' => 'Analyse and design structural elements for bridges, retaining walls, culverts, and large civil infrastructure across international project environments.',
                'image' => 'https://images.pexels.com/photos/1216589/pexels-photo-1216589.jpeg?auto=compress&cs=tinysrgb&w=800',
                'applyUrl' => route('contact'),
            ],
            [
                'id' => 7,
                'title' => 'GIS & Survey Specialist',
                'category' => 'engineering',
                'label' => 'Engineering & Design',
                'location' => 'India Hub / Remote',
                'type' => 'Full-time',
                'description' => 'Conduct GIS analysis, topographic data processing, and survey coordination to support feasibility studies and detailed engineering across all service lines.',
                'image' => 'https://images.pexels.com/photos/2219024/pexels-photo-2219024.jpeg?auto=compress&cs=tinysrgb&w=800',
                'applyUrl' => route('contact'),
            ],
            [
                'id' => 8,
                'title' => 'Digital Transformation Lead – Infrastructure',
                'category' => 'digital',
                'label' => 'Digital Twin & BIM',
                'location' => 'USA / Remote',
                'type' => 'Full-time',
                'description' => 'Drive adoption of digital delivery methodologies including parametric design, digital twins, and data-driven asset management across Alada project portfolios.',
                'image' => 'https://images.pexels.com/photos/373543/pexels-photo-373543.jpeg?auto=compress&cs=tinysrgb&w=800',
                'applyUrl' => route('contact'),
            ],
        ];

        return view('frontend.career', compact('jobs', 'categories'));
    }
}
