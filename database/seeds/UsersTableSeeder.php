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
        factory(Skywalker\User::class,29)->create();

        Skywalker\User::create([
            'name'=>'Caspar Lee',
            'email'=>'casplee@yahoo.com',
            'password'=>bcrypt('password1'),
        ]);
    }
}
