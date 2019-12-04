<?php

use Illuminate\Database\Seeder;

class SitesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sites')->delete();
        
        \DB::table('sites')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '/',
                'name' => '主站',
                'host' => NULL,
                'template' => 'default',
                'template_id' => 1,
                'status' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}