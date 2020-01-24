<?php

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'email' => 'irfanullah73@gmail.com',
                'token' => '$argon2i$v=19$m=1024,t=2,p=2$RzhWN3k3aU1hSnNTdjlDYg$izOVm5IRjHSNjGMal8zXeaG0c+11r4XqUWyZkG2lguE',
                'created_at' => '2020-01-11 22:51:51',
            ),
        ));
        
        
    }
}