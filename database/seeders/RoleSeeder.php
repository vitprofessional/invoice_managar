<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name'=>'Admin']);
        $admin = User::firstOrCreate(['email'=>'support@virtualitprofessional.com'],
            ['name'=>'Admin','password'=>Hash::make('youMoh@123')]);
        $admin->assignRole('Admin');
    }

    
}
