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
        User::create(['username' => 'admin', 'password' => bcrypt('admin')]);
        DB::table('settings')->delete();
    	DB::table('settings')->insert([
        	['name' => 'telephone', 'value' => '0497-123456'],
        	['name' => 'mobile', 'value' => '098950 97971'],
        	['name' => 'email', 'value' => 'info@rotanarestaurant.in'],
        	['name' => 'social', 'value' => '[{"id":"facebook","icon":"/img/social/facebook.png","label":"Facebook"},{"id":"twitter","icon":"/img/social/twitter.png","label":"Twitter"},{"id":"google","icon":"/img/social/google-plus.png","label":"Google Plus"},{"id":"pinterest","icon":"/img/social/pinterest.png","label":"Pinterest"},{"id":"instagram","icon":"/img/social/instagram.png","label":"Instagram"},{"id":"linkedin","icon":"/img/social/linkedin.png","label":"LinkedIn"}]'],
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
     	]);
    }
}
