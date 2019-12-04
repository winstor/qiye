<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2016_01_04_173148_create_admin_tables',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2019_01_28_112410_create_borns_table',
                'batch' => 2,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2019_01_31_094933_add_other_to_users_table',
                'batch' => 3,
            ),
            5 => 
            array (
                'id' => 12,
                'migration' => '2019_02_21_114949_create_admin_user_sites_table',
                'batch' => 8,
            ),
            6 => 
            array (
                'id' => 16,
                'migration' => '2019_02_19_152457_create_articles_table',
                'batch' => 10,
            ),
            7 => 
            array (
                'id' => 18,
                'migration' => '2019_02_19_142952_create_categories_table',
                'batch' => 11,
            ),
            8 => 
            array (
                'id' => 25,
                'migration' => '2019_02_19_095616_create_sites_table',
                'batch' => 12,
            ),
            9 => 
            array (
                'id' => 26,
                'migration' => '2019_02_19_153238_create_configs_table',
                'batch' => 12,
            ),
            10 => 
            array (
                'id' => 27,
                'migration' => '2019_03_26_100407_add_site_id_to_admin_users_table',
                'batch' => 12,
            ),
            11 => 
            array (
                'id' => 28,
                'migration' => '2019_03_26_101156_create_templates_table',
                'batch' => 13,
            ),
        ));
        
        
    }
}