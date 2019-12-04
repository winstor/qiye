<?php

use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('configs')->delete();
        
        \DB::table('configs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'site_id' => 1,
                'type' => 'web',
                'title' => NULL,
                'title2' => NULL,
                'keywords' => NULL,
                'description' => NULL,
                'desc' => NULL,
                'lx' => NULL,
                'icp' => NULL,
                'per_page' => 15,
                'data' => '[]',
                'logo' => NULL,
                'favicon' => NULL,
                'client_cert' => NULL,
                'client_key' => NULL,
                'created_at' => '2019-03-26 10:09:29',
                'updated_at' => '2019-03-26 10:09:29',
            ),
        ));
        
        
    }
}