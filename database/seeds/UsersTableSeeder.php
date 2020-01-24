<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test Admin',
                'first_name' => 'Test',
                'last_name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => '$2y$10$DpoUX9yNGXXTiF6Fg18sZ.WFbg096Hx17tA00I4oYA4YQ5Xta/V6m',
                'is_admin' => 1,
                'is_active' => 1,
                'remember_token' => NULL,
                'image' => NULL,
                'created_at' => '2019-07-23 00:00:00',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => NULL,
                'first_name' => 'Joe',
                'last_name' => NULL,
                'email' => 'joe@test.com',
                'password' => '$2y$10$DpoUX9yNGXXTiF6Fg18sZ.WFbg096Hx17tA00I4oYA4YQ5Xta/V6m',
                'is_admin' => 1,
                'is_active' => 1,
                'remember_token' => NULL,
                'image' => NULL,
                'created_at' => '2019-07-23 00:00:00',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'BULL DOG',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'thebull@gmail.com',
                'password' => '$2y$10$oYVZ7ZJ9cSpFevGir5SHFu6FzdflGOKRyZfrmYHGsXTyS6iyvbf7i',
                'is_admin' => 0,
                'is_active' => 0,
                'remember_token' => NULL,
                'image' => NULL,
                'created_at' => '2019-07-23 00:00:00',
                'updated_at' => '2019-07-16 11:54:46',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'John',
                'first_name' => 'Peck',
                'last_name' => 'Malik',
                'email' => 'jgerald@nethomefx.com',
                'password' => '$2y$10$DpoUX9yNGXXTiF6Fg18sZ.WFbg096Hx17tA00I4oYA4YQ5Xta/V6m',
                'is_admin' => 0,
                'is_active' => 0,
                'remember_token' => NULL,
                'image' => NULL,
                'created_at' => '2019-07-23 00:00:00',
                'updated_at' => '2019-07-29 14:41:39',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'John Brawo',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'john@example.com',
                'password' => '$2y$10$emSle6LCoEp4R7v7vLEL7OcRvrlYQYlKyNA0E41xyQTDPjcnY.QP2',
                'is_admin' => 0,
                'is_active' => 0,
                'remember_token' => NULL,
                'image' => NULL,
                'created_at' => '2019-07-29 14:38:43',
                'updated_at' => '2019-07-29 14:38:43',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'Test User',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'test@test.com',
                'password' => '$argon2i$v=19$m=1024,t=2,p=2$SnZESGl2aTRvNndEWW9nWQ$gt5tDvma6cPv2WtVWpyH7MU+x5tTb/6nl1RsLPYXVIg',
                'is_admin' => 0,
                'is_active' => 0,
                'remember_token' => NULL,
                'image' => NULL,
                'created_at' => '2019-11-01 18:18:25',
                'updated_at' => '2019-11-01 18:18:25',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'qwqwq asasa',
                'first_name' => NULL,
                'last_name' => NULL,
                'email' => 'irfanullah73@gmail.com',
                'password' => '$argon2i$v=19$m=1024,t=2,p=2$RUU5WXZsRUwyeC90cHpRZw$in9vy8r99zD+gBJiAoq3BvBVqB0BlJWAbF4zXME32VM',
                'is_admin' => 0,
                'is_active' => 0,
                'remember_token' => NULL,
                'image' => NULL,
                'created_at' => '2019-11-24 20:20:29',
                'updated_at' => '2019-11-24 20:20:29',
            ),
        ));
        
        
    }
}