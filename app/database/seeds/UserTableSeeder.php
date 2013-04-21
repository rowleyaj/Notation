<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        $user = new User;
        $user->email = 'steve228uk@gmail.com';
        $user->password = Hash::make('password');
        $user->save();
    }

}