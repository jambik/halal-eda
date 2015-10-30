<?php

use App\Garnish;
use Illuminate\Database\Seeder;

class GarnishsTableSeeder extends Seeder {

	protected $items = [
		['Рис белый', 'Обычный рис', '250 мл.', 100, 'garnish-1.jpg'],
		['Рис коричневый', 'Коричневый - самый полезный рис', '250 мл.', 100, 'garnish-2.jpg'],
		['Гречка', 'Гречка - царица всех круп', '250 мл.', 100, 'garnish-3.jpg'],
		['Макароны', 'Тесто - не очень полезная еда', '250 мл.', 100, 'garnish-4.jpg'],
		['Пшеничная каша', 'Полезна для желудка', '250 мл.', 100, 'garnish-5.jpg'],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('garnishs')->delete();

		for($i=0; $i<count($this->items); $i++)
		{
			$row = array_combine(['name', 'description', 'weight', 'price', 'image'], $this->items[$i]);

			Garnish::create($row);
		}
	}

}
