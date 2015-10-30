<?php

use App\Drink;
use Illuminate\Database\Seeder;

class DrinksTableSeeder extends Seeder {

	protected $items = [
		['Кураговый компот', 'Кураговый компот -  что может быть лучше', '250 мл.', 110, 'drink-1.jpg'],
		['Яблочный сок', 'Яблочный сок тонизирует', '250 мл.', 90, 'drink-2.jpg'],
		['Апельсиновый сок', 'Апельсин такой оранжевый', '250 мл.', 100, 'drink-3.jpg'],
		['Минеральная вода', 'Минеральная вода всем голова', '250 мл.', 130, 'drink-4.jpg'],
		['Кока-кола', 'Очень неполезный напиток', '250 мл.', 80, 'drink-5.jpg'],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('drinks')->delete();

		for($i=0; $i<count($this->items); $i++)
		{
			$row = array_combine(['name', 'description', 'weight', 'price', 'image'], $this->items[$i]);

			Drink::create($row);
		}
	}

}
