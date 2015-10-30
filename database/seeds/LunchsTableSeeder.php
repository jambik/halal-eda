<?php

use App\Lunch;
use Illuminate\Database\Seeder;

class LunchsTableSeeder extends Seeder {

	protected $items = [
		['Обед 1', 'Вкусный обед', 1, 1, 1, 1, 1, 499, 'lunch-1.jpg'],
		['Обед 2', 'Рекомендуем этот обед', 2, 2, 2, 2, 2, 399, 'lunch-2.jpg'],
		['Обед 3', 'Очень легкий обед', 3, 3, 3, 3, 3, 349, 'lunch-3.jpg'],
		['Обед 4', 'Обед с кучей витаминов', 4, 4, 4, 4, 4, 319, 'lunch-4.jpg'],
		['Обед 5', 'Питательный обед', 5, 5, 5, 5, 5, 299, 'lunch-5.jpg'],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('lunchs')->delete();

		for($i=0; $i<count($this->items); $i++)
		{
			$row = array_combine(['name', 'description', 'meal1_id', 'meal2_id', 'garnish_id', 'salad_id', 'drink_id', 'price', 'image'], $this->items[$i]);

			$lunch = Lunch::create($row);
			$lunch->additions()->attach([1, 2, 3]);
		}
	}

}
