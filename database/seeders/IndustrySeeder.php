<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $industries = [
            ['name'=>'Energy & LNG',            'icon'=>'bolt',               'description'=>'LNG facilities, refineries, pipelines and energy networks designed to global safety standards.', 'order'=>1],
            ['name'=>'Oil & Gas',               'icon'=>'beaker',             'description'=>'Process plants, pipeline systems and industrial infrastructure for oil and gas operations.', 'order'=>2],
            ['name'=>'Transportation',           'icon'=>'truck',              'description'=>'Roads, highways, rail corridors and transport network design for efficient mobility.', 'order'=>3],
            ['name'=>'Water Infrastructure',     'icon'=>'globe-alt',          'description'=>'Water supply, wastewater, stormwater and hydraulic systems for communities and industry.', 'order'=>4],
            ['name'=>'Smart Cities',             'icon'=>'map',                'description'=>'Urban master planning, GIS-driven development and digital city infrastructure.', 'order'=>5],
            ['name'=>'Commercial Buildings',     'icon'=>'building-library',   'description'=>'Architectural design and structural engineering for commercial and institutional facilities.', 'order'=>6],
            ['name'=>'Industrial Facilities',    'icon'=>'building-office',    'description'=>'Industrial plant design, layout engineering and MEPF integration for manufacturing and processing.', 'order'=>7],
            ['name'=>'Renewable Energy',         'icon'=>'sparkles',           'description'=>'Solar, wind and hybrid energy infrastructure designed for performance and sustainability.', 'order'=>8],
        ];

        foreach ($industries as $ind) {
            Industry::updateOrCreate(['name' => $ind['name']], array_merge($ind, ['is_active' => true]));
        }
    }
}
