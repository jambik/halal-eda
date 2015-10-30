<?php

use App\Contact;
use Illuminate\Database\Seeder;

class ContactsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('contacts')->delete();

		Contact::create([
			'name' => 'Джанбулат Магомаев',
			'phone' => '+79034297801',
			'city' => 'Москва',
			'metro' => 'Авиамоторная',
			'street' => 'ул. Авиамоторная',
			'house' => '65а',
			'corpus' => '2',
			'building' => '1',
			'apartment' => '55',
			'entrance' => '1',
			'floor' => '9',
			'intercom' => '0098',
			'comment' => 'положите у дверей'
		]);

		Contact::create([
			'name' => 'Арслан Аджиев',
			'phone' => '+7 985 666-65-66',
			'city' => 'Москва',
			'metro' => 'Молодежная',
			'street' => 'ул. Молодежная',
			'house' => '23',
			'corpus' => '1',
			'building' => '',
			'apartment' => '12',
			'entrance' => '2',
			'floor' => '1',
			'intercom' => '7485',
			'comment' => 'звоните перед доставкой'
		]);
	}

}
