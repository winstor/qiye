<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('articles')->delete();
        
        \DB::table('articles')->insert(array (
            0 => 
            array (
                'id' => 2,
                'title' => 'ads',
                'site_id' => 1,
                'category_id' => 2,
                'keywords' => 'asd',
                'author' => NULL,
                'from' => NULL,
                'is_top' => 1,
                'is_hot' => 0,
                'hits' => 1,
                'note' => NULL,
                'img' => NULL,
                'is_img' => 1,
                'content' => '<p>sadasfdfg</p>',
                'created_at' => '2019-03-08 11:50:41',
                'updated_at' => '2019-03-26 10:41:10',
            ),
            1 => 
            array (
                'id' => 3,
                'title' => 'tdstdt',
                'site_id' => 1,
                'category_id' => 2,
                'keywords' => 'sdfdf',
                'author' => NULL,
                'from' => NULL,
                'is_top' => 0,
                'is_hot' => 0,
                'hits' => 1,
                'note' => NULL,
                'img' => 'images/dfsfsdf.png',
                'is_img' => 0,
                'content' => '<p>sdfsdf</p>',
                'created_at' => '2019-03-08 15:24:48',
                'updated_at' => '2019-03-22 09:51:15',
            ),
        ));
        
        
    }
}