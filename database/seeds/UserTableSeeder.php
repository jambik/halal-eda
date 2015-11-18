<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'jambik',
            'email' => 'jambik@gmail.com',
            'password' => bcrypt('111111'),
            'contact_id' => 1
        ]);

        User::create([
            'name' => 'Арслан',
            'email' => 'ruskum05@mail.ru',
            'password' => bcrypt('rus05kum05'),
            'contact_id' => 2
        ]);

        User::create([
            'name' => 'Камилла',
            'email' => 'kama85@gmail.com',
            'password' => '',
            'contact_id' => null
        ]);

        Role::create(['name' => 'admin', 'display_name' => 'Administrator', 'description' => 'Администратор сайта']);

        $user = User::find(1);
        $user->attachRole(1);

        $user = User::find(2);
        $user->attachRole(1);
    }

}
