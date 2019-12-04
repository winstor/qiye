<?php

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => '首页',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-02-22 11:15:43',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 2,
                'title' => 'admin',
                'icon' => 'fa-tasks',
                'uri' => NULL,
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-02-20 09:44:56',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-02-20 09:46:05',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-02-20 09:45:55',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Permissions',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-02-20 09:46:26',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => NULL,
                'created_at' => NULL,
                'updated_at' => '2019-02-20 09:50:55',
            ),
            6 => 
            array (
                'id' => 9,
                'parent_id' => 0,
                'order' => 14,
                'title' => '日志管理',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => 'logs',
                'created_at' => '2019-02-18 17:27:30',
                'updated_at' => '2019-03-26 11:15:10',
            ),
            7 => 
            array (
                'id' => 12,
                'parent_id' => 0,
                'order' => 13,
                'title' => '文章管理',
                'icon' => 'fa-book',
                'uri' => '/articles',
                'permission' => 'articles',
                'created_at' => '2019-02-19 14:53:08',
                'updated_at' => '2019-03-26 11:15:10',
            ),
            8 => 
            array (
                'id' => 13,
                'parent_id' => 0,
                'order' => 12,
                'title' => '分类管理',
                'icon' => 'fa-columns',
                'uri' => 'categories',
                'permission' => 'articles',
                'created_at' => '2019-02-19 15:14:50',
                'updated_at' => '2019-03-26 11:15:10',
            ),
            9 => 
            array (
                'id' => 15,
                'parent_id' => 0,
                'order' => 11,
                'title' => '网站设置',
                'icon' => 'fa-amazon',
                'uri' => 'configs/web/edit',
                'permission' => 'articles',
                'created_at' => '2019-02-19 15:39:06',
                'updated_at' => '2019-03-26 11:15:10',
            ),
            10 => 
            array (
                'id' => 18,
                'parent_id' => 0,
                'order' => 9,
                'title' => '站点管理',
                'icon' => 'fa-anchor',
                'uri' => 'sites',
                'permission' => 'superUsers',
                'created_at' => '2019-02-20 10:12:44',
                'updated_at' => '2019-03-26 11:15:10',
            ),
            11 => 
            array (
                'id' => 19,
                'parent_id' => 0,
                'order' => 7,
                'title' => '管理员',
                'icon' => 'fa-android',
                'uri' => 'superUsers',
                'permission' => 'superUsers',
                'created_at' => '2019-02-20 10:13:24',
                'updated_at' => '2019-03-25 10:06:41',
            ),
            12 => 
            array (
                'id' => 23,
                'parent_id' => 0,
                'order' => 10,
                'title' => '管理员',
                'icon' => 'fa-github-alt',
                'uri' => 'adminUsers',
                'permission' => 'adminUsers',
                'created_at' => '2019-03-19 14:16:59',
                'updated_at' => '2019-03-26 11:15:10',
            ),
            13 => 
            array (
                'id' => 24,
                'parent_id' => 0,
                'order' => 8,
                'title' => '模板管理',
                'icon' => 'fa-cubes',
                'uri' => 'templates',
                'permission' => 'superUsers',
                'created_at' => '2019-03-26 11:14:55',
                'updated_at' => '2019-03-26 11:15:09',
            ),
        ));
        
        
    }
}