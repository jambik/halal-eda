<?php

use App\Meal1;
use Illuminate\Database\Seeder;

class Meal1TableSeeder extends Seeder {

	protected $items = [
		['Борщ зеленый', 'Вкусный зеленый борщ. Освежающий', 'капуста, яйца, зелень, соль, перец', '250 г.', 110, 'meal1-1.jpg'],
		['Борщ красный', 'Красный борщ. Вкусный и полезный', 'капуста, бурак, морковь, яйца, зелень, соль, перец', '200 г.', 90, 'meal1-2.jpg'],
		['Лагман', 'Фирменное блюдо узбеков', 'картошка, морковь, бурак, зелень, соль, перец', '250 г.', 130, 'meal1-3.jpg'],
		['Соус куринный', 'Легкий суп с курицей', 'картошка, морковь, бурак, зелень, соль, перец', '150 г.', 100, 'meal1-4.jpg'],
		['Акрошка', 'Холодный освежающий суп', 'кефир, огурцы, картошка, зелень, соль, перец', '180 г.', 80, 'meal1-5.jpg'],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('meal1')->delete();

		for($i=0; $i<count($this->items); $i++)
		{
			$row = array_combine(['name', 'description', 'consist', 'weight', 'price', 'image'], $this->items[$i]);

			Meal1::create($row);
		}
	}

}
