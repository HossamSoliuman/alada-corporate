<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key'=>'site_name',       'value'=>'Alada',                              'group'=>'general',  'type'=>'text'],
            ['key'=>'site_tagline',    'value'=>'Growing With Time',                  'group'=>'general',  'type'=>'text'],
            ['key'=>'logo_url',        'value'=>'images/alada-logo.png',              'group'=>'general',  'type'=>'image'],
            ['key'=>'favicon_url',     'value'=>'',                                   'group'=>'general',  'type'=>'image'],
            ['key'=>'footer_text',     'value'=>'© '.date('Y').' Alada. Global Engineering, Infrastructure & Energy Solutions. All rights reserved.', 'group'=>'general','type'=>'textarea'],
            ['key'=>'default_og_image','value'=>'',                                   'group'=>'general',  'type'=>'image'],
            ['key'=>'meta_description','value'=>'Alada is a globally integrated, multi-disciplinary engineering and infrastructure consultancy delivering complex, high-performance projects worldwide.', 'group'=>'general','type'=>'textarea'],

            ['key'=>'contact_email',   'value'=>'info@alada.com',                     'group'=>'contact',  'type'=>'text'],
            ['key'=>'phone',           'value'=>'',                                   'group'=>'contact',  'type'=>'text'],
            ['key'=>'whatsapp_number', 'value'=>'',                                   'group'=>'contact',  'type'=>'text'],
            ['key'=>'address',         'value'=>'United States of America',           'group'=>'contact',  'type'=>'textarea'],
            ['key'=>'address_india',   'value'=>'India Engineering Center',           'group'=>'contact',  'type'=>'textarea'],

            ['key'=>'social_facebook', 'value'=>'',                                   'group'=>'social',   'type'=>'text'],
            ['key'=>'social_twitter',  'value'=>'',                                   'group'=>'social',   'type'=>'text'],
            ['key'=>'social_linkedin', 'value'=>'',                                   'group'=>'social',   'type'=>'text'],
            ['key'=>'social_instagram','value'=>'',                                   'group'=>'social',   'type'=>'text'],

            ['key'=>'ga4_id',          'value'=>'',                                   'group'=>'analytics','type'=>'text'],
            ['key'=>'gtm_id',          'value'=>'',                                   'group'=>'analytics','type'=>'text'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}
