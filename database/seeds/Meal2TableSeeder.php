<?php

use App\Meal2;
use Illuminate\Database\Seeder;

class Meal2TableSeeder extends Seeder {

	protected $items = [
		['Котлеты куринные', 'Вкусные куринные котлеты', 'куринный фарш, зелень, соль, перец', '200 г.', 110, 'meal2-1.jpg'],
		['Котлеты говяжьи', 'Вкусные говяжьи котлеты', 'рис, говядина, зелень, соль, перец', '150 г.', 90, 'meal2-2.jpg'],
		['Гуляш', 'Мясо, много мяса', 'баранина, зелень, соль, перец', '180 г.', 100, 'meal2-3.jpg'],
		['Рыба', 'Рыба очень полезна', 'рыба, зелень, соль, перец', '200 г.', 130, 'meal2-4.jpg'],
		['Курица', 'Запеченная курица', 'курица, зелень, соль, перец', '180 г.', 80, 'meal2-5.jpg'],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('meal2')->delete();

		for($i=0; $i<count($this->items); $i++)
		{
			$row = array_combine(['name', 'description', 'consist', 'weight', 'price', 'image'], $this->items[$i]);

			Meal2::create($row);
		}
	}

}
