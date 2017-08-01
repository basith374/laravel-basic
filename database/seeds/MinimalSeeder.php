<?php

use Illuminate\Database\Seeder;

class MinimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->delete();
        App\User::create(['username' => 'admin', 'password' => bcrypt('admin'), 'name' => 'Admin']);
        DB::table('settings')->delete();
    	DB::table('settings')->insert([
            ['name' => 'brand', 'value' => 'Brand'],
            ['name' => 'address', 'value' => 'SKR Complex, Banglore'],
            ['name' => 'marker', 'value' => '13.0299335,77.559585'],
            ['name' => 'map_zoom', 'value' => '3'],
            ['name' => 'telephone', 'value' => '0497-123456'],
            ['name' => 'telephone2', 'value' => '0497-123456'],
            ['name' => 'mobile', 'value' => '09876 543 210'],
            ['name' => 'mobile2', 'value' => '09876 543 210'],
        	['name' => 'email', 'value' => 'info@brand.com'],
        	['name' => 'social', 'value' => json_encode([
                ['id' => 'facebook', 'icon' => 'fa fa-facebook', 'label' => 'Facebook'],
                ['id' => 'twitter', 'icon' => 'fa fa-twitter', 'label' => 'Twitter'],
                ['id' => 'google', 'icon' => 'fa fa-google-plus', 'label' => 'Google Plus'],
                ['id' => 'pinterest', 'icon' => 'fa fa-pinterest', 'label' => 'Pinterest'],
                ['id' => 'instagram', 'icon' => 'fa fa-instagram', 'label' => 'Instagram'],
                ['id' => 'linkedin', 'icon' => 'fa fa-linkedin', 'label' => 'LinkedIn'],
            ])],
            ['name' => 'facebook', 'value' => ''],
            ['name' => 'twitter', 'value' => ''],
            ['name' => 'google', 'value' => ''],
            ['name' => 'pinterest', 'value' => ''],
            ['name' => 'instagram', 'value' => ''],
            ['name' => 'linkedin', 'value' => ''],
            ['name' => 'google_analytics', 'value' => ''],
            ['name' => 'google_verification', 'value' => ''],
            ['name' => 'bing_verification', 'value' => ''],
            ['name' => 'pinterest_verification', 'value' => '']
            ['name' => 'tinify_key', 'value' => '']
     	]);
    }
}
