<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('content_sites')->insert([
            'domain' => Str::random(10),
            'throttle' => Str::random(10).'@gmail.com',
            'time_value' => Str::random(3),
            'site_name' => Str::random(15),
            'vertical_id' => 
            'password' => Hash::make('password'),
        ]);
    }
}
