<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
        'company_name'=>'Virtual IT Professional',
        'company_email'=>'support@virtualitprofessional.com',
        'company_phone'=>'+971566238304',
        'company_address'=>'Building No-108, Near Satwa Big Masjid, Satwa, Dubai',
        'default_currency'=>'USD',
        'invoice_prefix'=>'INV',
        'company_logo'=>'images/logo.png',
        'company_watermark'=>'images/logo-watermark.png'
        ];
        foreach($settings as $k=>$v) Setting::updateOrCreate(['key'=>$k],['value'=>$v]);
    }
}
