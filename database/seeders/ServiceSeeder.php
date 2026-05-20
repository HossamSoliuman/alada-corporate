<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'              => 'Infrastructure & Societal Development Engineering',
                'icon'              => 'building-office-2',
                'short_description' => 'Comprehensive infrastructure engineering across the full lifecycle of societal and civil development projects.',
                'description'       => '<p>Alada provides comprehensive infrastructure engineering services covering the full lifecycle of societal and civil development projects. The company specialises in transforming conceptual ideas into fully functional infrastructure systems through integrated planning, design, and execution methodologies.</p><p>The scope includes land development, site grading, utility coordination, and infrastructure network planning, ensuring that all components — from roads and drainage to utilities — are seamlessly integrated. Alada\'s engineering approach emphasises efficiency, durability, and long-term performance.</p>',
                'is_featured'       => true,  'order' => 1,
            ],
            [
                'name'              => 'Architectural Design Services',
                'icon'              => 'building-library',
                'short_description' => 'High-quality architectural services combining modern design principles with engineering precision and BIM-driven visualisation.',
                'description'       => '<p>Alada delivers high-quality architectural services combining modern design principles with engineering precision. The focus is on creating structures that are not only aesthetically appealing but also technically efficient and sustainable.</p><p>The design process integrates space planning, environmental considerations, structural coordination, and BIM-driven visualisation, enabling accurate representation and optimisation of building performance. Alada ensures that all designs meet international standards and client requirements.</p>',
                'is_featured'       => true,  'order' => 2,
            ],
            [
                'name'              => 'Urban Planning & Smart City Development',
                'icon'              => 'map',
                'short_description' => 'Advanced urban planning solutions integrating land-use, transportation, environmental and digital infrastructure into cohesive city models.',
                'description'       => '<p>Alada provides advanced urban planning solutions focused on developing smart, sustainable, and future-ready urban environments. The company integrates land-use planning, transportation systems, environmental considerations, and digital infrastructure into cohesive city development models.</p><p>Using advanced tools such as GIS mapping, urban simulation, and data-driven planning, Alada creates master plans that optimise mobility, sustainability, and livability.</p>',
                'is_featured'       => true,  'order' => 3,
            ],
            [
                'name'              => 'Transportation Infrastructure Engineering',
                'icon'              => 'truck',
                'short_description' => 'Roads, highways, and rail infrastructure design with advanced corridor optimisation, traffic analysis, and terrain modelling.',
                'description'       => '<p>Alada specialises in designing and optimising transport systems, including roads, highways, and rail infrastructure. The company focuses on enhancing mobility, safety, and efficiency through advanced engineering techniques.</p><p>Services include corridor design, alignment optimisation, traffic analysis, and pavement engineering, supported by terrain modelling and infrastructure simulation tools.</p>',
                'is_featured'       => true,  'order' => 4,
            ],
            [
                'name'              => 'Water, Wastewater & Drainage Engineering',
                'icon'              => 'beaker',
                'short_description' => 'Technically advanced water management systems — supply networks, sewer systems, stormwater drainage, and hydraulic infrastructure.',
                'description'       => '<p>Alada delivers technically advanced water management systems, ensuring efficient and sustainable utilisation of water resources.</p><p>The company designs water supply networks, sewer systems, stormwater drainage, and hydraulic infrastructure, supported by advanced modelling tools to optimise flow efficiency and performance.</p>',
                'is_featured'       => true,  'order' => 5,
            ],
            [
                'name'              => 'Environmental Engineering & Hydrogeology',
                'icon'              => 'globe-alt',
                'short_description' => 'Environmental consultancy addressing soil, water, and ecological conditions with contamination analysis and impact assessments.',
                'description'       => '<p>Alada provides environmental consultancy services addressing soil, water, and ecological conditions, ensuring regulatory compliance and sustainable development.</p><p>Services include contamination analysis, groundwater studies, environmental impact assessments, and sustainable infrastructure planning.</p>',
                'is_featured'       => true,  'order' => 6,
            ],
            [
                'name'              => 'Structural Engineering',
                'icon'              => 'building-office',
                'short_description' => 'Structural design for complex buildings, bridges, and industrial facilities using advanced analysis tools and global engineering standards.',
                'description'       => '<p>Alada provides structural design services for complex infrastructure projects including buildings, bridges, and industrial facilities.</p><p>The company ensures structural integrity, safety, and durability, using advanced analysis tools and global engineering standards.</p>',
                'is_featured'       => false, 'order' => 7,
            ],
            [
                'name'              => 'BIM & Digital Engineering',
                'icon'              => 'cpu-chip',
                'short_description' => 'Advanced BIM technologies for project coordination, 3D modelling, clash detection, and real-time collaboration.',
                'description'       => '<p>Alada utilises advanced BIM technologies to enhance project coordination, reduce errors, and improve efficiency across all disciplines.</p><p>The use of 3D modelling, clash detection, and simulation enables real-time collaboration and precise engineering outputs, reducing rework and accelerating delivery timelines.</p>',
                'is_featured'       => false, 'order' => 8,
            ],
            [
                'name'              => 'Project & Construction Management',
                'icon'              => 'chart-bar',
                'short_description' => 'Complete project management services ensuring on-time, on-budget delivery with planning, cost control, and on-site supervision.',
                'description'       => '<p>Alada provides complete management services ensuring projects are delivered on time, within budget, and with high quality.</p><p>This includes planning, cost control, scheduling, and on-site supervision — ensuring seamless coordination between all project stakeholders from inception to handover.</p>',
                'is_featured'       => false, 'order' => 9,
            ],
            [
                'name'              => 'Industrial, LNG, Oil & Gas & Energy Engineering',
                'icon'              => 'bolt',
                'short_description' => 'Specialised energy and industrial infrastructure including LNG facilities, oil refineries, power plants, and renewable energy solutions.',
                'description'       => '<p>Alada offers specialised services in energy and industrial infrastructure, including LNG facilities, oil refineries, power plants, and renewable energy solutions.</p><p>The company designs pipeline systems, process plants, energy networks, and solar infrastructure, ensuring efficiency, safety, and sustainability across all energy project types.</p>',
                'is_featured'       => false, 'order' => 10,
            ],
            [
                'name'              => 'MEPF Engineering Services',
                'icon'              => 'cog-6-tooth',
                'short_description' => 'Integrated mechanical, electrical, plumbing, and fire protection systems designed using BIM for seamless building integration.',
                'description'       => '<p>Alada delivers integrated MEPF services covering mechanical, electrical, plumbing, and fire protection systems.</p><p>These systems are designed using BIM to ensure seamless integration with building and industrial infrastructure, improving coordination, reducing clashes, and ensuring regulatory compliance.</p>',
                'is_featured'       => false, 'order' => 11,
            ],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(['name' => $svc['name']], array_merge($svc, ['is_active' => true]));
        }
    }
}
