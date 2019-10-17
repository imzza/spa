<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'email' =>'admin@test.com',   
                'password' =>Hash::make('123456'),
                'is_admin' =>'1',
                'is_active' =>'1',
            ],
        ]);
    }
}
