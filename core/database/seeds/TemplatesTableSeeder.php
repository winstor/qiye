<?php

use Illuminate\Database\Seeder;

class TemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('templates')->delete();
        
        \DB::table('templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '默认模板',
                'template' => 'temp_default',
                'file' => NULL,
                'status' => 1,
                'created_at' => '2019-03-26 11:22:21',
                'updated_at' => '2019-03-26 11:22:23',
            ),
        ));
        
        
    }
}