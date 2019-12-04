<?php

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_roles')->delete();
        
        \DB::table('admin_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'administrator',
                'slug' => 'administrator',
                'created_at' => '2019-01-25 16:26:07',
                'updated_at' => '2019-02-20 11:36:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '超级管理员',
                'slug' => 'super',
                'created_at' => '2019-02-18 17:52:40',
                'updated_at' => '2019-02-21 17:44:56',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '管理员',
                'slug' => 'admin',
                'created_at' => '2019-02-20 10:02:01',
                'updated_at' => '2019-02-21 17:44:10',
            ),
        ));
        
        
    }
}