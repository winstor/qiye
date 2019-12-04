<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'administrator',
                'password' => '$2y$10$EGnxSSH8P3UfG6s731jK0eOGt2KiX0hOIn2DQYC7dwMPNTENqf.iO',
                'name' => 'Administrator',
                'avatar' => NULL,
                'remember_token' => 'lH1LBlsrimpos0IEYRmGLmpy4YJTMjIvxh957ENctOpllIpf59gPvfE6QmMn',
                'created_at' => '2019-01-25 16:26:07',
                'updated_at' => '2019-02-20 11:36:04',
                'site_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'super',
                'password' => '$2y$10$BPA1tdt6kysnmTnBcrz3/.VWEizb3kc8vQW2S2RmAFenPFZKeBly6',
                'name' => '超级管理员',
                'avatar' => NULL,
                'remember_token' => '748vMWW19GCLwRjRKkxS48qRFwoN3btmP4s8akR8hQyURgVreXv3zCONANG7',
                'created_at' => '2019-02-20 10:05:56',
                'updated_at' => '2019-03-25 10:47:47',
                'site_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'username' => 'admin',
                'password' => '$2y$10$Y8UaTb7AMTj4hfxq/0JIjOpr.inUAQMkrcJuivNEUrI2Rcq./daXa',
                'name' => '小名',
                'avatar' => NULL,
                'remember_token' => 'eryOX6IphRZT2XSaNZSe8FoFRcS55l5pw0M9tFYxNqt31TWe3stgM1li26R3',
                'created_at' => '2019-02-20 10:47:59',
                'updated_at' => '2019-03-25 10:48:54',
                'site_id' => 1,
            ),
        ));
        
        
    }
}