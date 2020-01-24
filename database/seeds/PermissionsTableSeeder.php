<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'dashboard',
                'guard_name' => 'web',
                'created_at' => '2019-07-12 17:36:51',
                'updated_at' => NULL,
                'key' => 'Dashboard',
                'type' => 'Dashboard',
            ),
            1 => 
            array (
                'id' => 17,
                'name' => 'role_and_permissions',
                'guard_name' => 'web',
                'created_at' => '2019-07-12 17:36:51',
                'updated_at' => NULL,
                'key' => 'Roles & Permissions',
                'type' => 'Roles And Permissions',
            ),
            2 => 
            array (
                'id' => 18,
                'name' => 'roles',
                'guard_name' => 'web',
                'created_at' => '2019-07-12 17:36:51',
                'updated_at' => NULL,
                'key' => 'Roles Index',
                'type' => 'Roles And Permissions',
            ),
            3 => 
            array (
                'id' => 19,
                'name' => 'roles_add',
                'guard_name' => 'web',
                'created_at' => '2019-07-12 17:36:51',
                'updated_at' => NULL,
                'key' => 'Add Role',
                'type' => 'Roles And Permissions',
            ),
            4 => 
            array (
                'id' => 20,
                'name' => 'roles_edit',
                'guard_name' => 'web',
                'created_at' => '2019-07-12 17:36:51',
                'updated_at' => NULL,
                'key' => 'Update Role',
                'type' => 'Roles And Permissions',
            ),
            5 => 
            array (
                'id' => 21,
                'name' => 'roles_delete',
                'guard_name' => 'web',
                'created_at' => '2019-07-12 17:36:51',
                'updated_at' => NULL,
                'key' => 'Delete Role',
                'type' => 'Roles And Permissions',
            ),
            6 => 
            array (
                'id' => 22,
                'name' => 'permissions_assign',
                'guard_name' => 'web',
                'created_at' => '2019-07-12 17:36:51',
                'updated_at' => NULL,
                'key' => 'Assign Permissions',
                'type' => 'Roles And Permissions',
            ),
            7 => 
            array (
                'id' => 23,
                'name' => 'table',
                'guard_name' => 'web',
                'created_at' => '2019-09-17 11:43:29',
                'updated_at' => NULL,
                'key' => 'DataTable',
                'type' => 'Datatable',
            ),
        ));
        
        
    }
}