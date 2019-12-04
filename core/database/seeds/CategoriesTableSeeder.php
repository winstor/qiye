<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => '生活用品',
                'parent_id' => 0,
                'site_id' => 1,
                'desc' => NULL,
                'logo' => NULL,
                'is_index' => 0,
                'index_order' => 10,
                'is_menu' => 1,
                'order' => 10,
                'created_at' => '2019-03-05 16:56:23',
                'updated_at' => '2019-03-06 16:38:45',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'a',
                'parent_id' => 1,
                'site_id' => 1,
                'desc' => NULL,
                'logo' => NULL,
                'is_index' => 0,
                'index_order' => 10,
                'is_menu' => 0,
                'order' => 10,
                'created_at' => '2019-03-05 17:17:54',
                'updated_at' => '2019-03-19 17:13:46',
            ),
            2 => 
            array (
                'id' => 6,
                'title' => '站点管理',
                'parent_id' => 0,
                'site_id' => 1,
                'desc' => 'gdf',
                'logo' => NULL,
                'is_index' => 0,
                'index_order' => 10,
                'is_menu' => 0,
                'order' => 10,
                'created_at' => '2019-03-06 10:23:18',
                'updated_at' => '2019-03-19 17:13:45',
            ),
        ));
        
        
    }
}