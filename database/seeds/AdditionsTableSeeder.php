<?php

use App\Addition;
use Illuminate\Database\Seeder;

class AdditionsTableSeeder extends Seeder {

	protected $items = [
		['Черный хлеб', 'Лучше черный чем белый', '50 г.', 10, 'addition-1.jpg'],
		['Булка сдобная', 'Лучше черный хлеб', '50 г.', 20, 'addition-2.jpg'],
		['Пластиковая посуда', 'Тарелка, ложка, вилка, зубочистка', '', 10, 'addition-3.jpg'],
		['Салфетки бумажные', 'Нежные салфетки', '', 0, 'addition-4.jpg'],
		['Салфетки влажные', 'Чистые влажные салфетки', '', 10, 'addition-5.jpg']
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('additions')->delete();

		for($i=0; $i<count($this->items); $i++)
		{
			$row = array_combine(['name', 'description', 'weight', 'price', 'image'], $this->items[$i]);

			Addition::create($row);
		}
	}

}
