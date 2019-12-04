<?php

use Illuminate\Database\Seeder;

class AdminPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_permissions')->delete();
        
        \DB::table('admin_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'All',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*',
                'created_at' => NULL,
                'updated_at' => '2019-02-19 14:28:48',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '首页',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/',
                'created_at' => NULL,
                'updated_at' => '2019-03-25 09:49:42',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '登录',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => '/auth/login
/auth/logout',
                'created_at' => NULL,
                'updated_at' => '2019-03-25 09:49:52',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'User setting',
                'slug' => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path' => '/auth/setting',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Auth management',
                'slug' => 'auth.management',
                'http_method' => '',
                'http_path' => '/auth/roles
/auth/permissions
/auth/menu
/auth/logs',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '设置分类文章',
                'slug' => 'articles',
                'http_method' => '',
                'http_path' => '/categories*
/articles*
/configs*',
                'created_at' => '2019-02-19 14:12:29',
                'updated_at' => '2019-03-25 09:52:59',
            ),
            6 => 
            array (
                'id' => 12,
                'name' => '日志',
                'slug' => 'logs',
                'http_method' => '',
                'http_path' => '/auth/logs*',
                'created_at' => '2019-02-20 10:25:59',
                'updated_at' => '2019-03-25 11:01:24',
            ),
            7 => 
            array (
                'id' => 17,
                'name' => '超级管理',
                'slug' => 'superUsers',
                'http_method' => '',
                'http_path' => '/superUsers*
/sites*
/templates*',
                'created_at' => '2019-02-25 15:58:32',
                'updated_at' => '2019-03-27 13:57:14',
            ),
            8 => 
            array (
                'id' => 18,
                'name' => '网站管理员',
                'slug' => 'adminUsers',
                'http_method' => '',
                'http_path' => '/adminUsers*',
                'created_at' => '2019-03-25 10:06:20',
                'updated_at' => '2019-03-25 10:07:41',
            ),
        ));
        
        
    }
}