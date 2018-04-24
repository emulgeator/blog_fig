<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('name', '=', 'author')->delete();

        $user = new User();

        $user->name     = 'author';
        $user->email    ='author@test.com';
        $user->password = bcrypt('secret');

        $user->save();
    }
}
