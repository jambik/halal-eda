<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('ContactsTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('Meal1TableSeeder');
        $this->call('Meal2TableSeeder');
        $this->call('GarnishsTableSeeder');
        $this->call('SaladsTableSeeder');
        $this->call('DrinksTableSeeder');
        $this->call('AdditionsTableSeeder');
        $this->call('LunchsTableSeeder');
    }

}
