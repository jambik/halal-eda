<?php

use App\Salad;
use Illuminate\Database\Seeder;

class SaladsTableSeeder extends Seeder {

	protected $items = [
		['Крабовый салат', 'Вкусный крабовый салат', 'гречка, котлеты мясные, зелень, соль, перец', '200 г.', 110, 'salad-1.jpg'],
		['Грибной салат', 'Грибной салат из веселых грибочков', 'рис, говядина, зелень, соль, перец', '150 г.', 90, 'salad-2.jpg'],
		['Московский салат', 'Московский салат был придуман в москве', 'рис, баранина, картошка, морковь, зелень, соль, перец', '180 г.', 100, 'salad-3.jpg'],
		['Морковный салат', 'Морковна очень полезный продукт', 'макароны, куринные котлеты, зелень, соль, перец', '200 г.', 130, 'salad-4.jpg'],
		['Бурачный салат', 'Бурак для пищеварения очень полезен', 'пшеничная крупа, говядина зелень, соль, перец', '180 г.', 80, 'salad-5.jpg'],
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('salads')->delete();

		for($i=0; $i<count($this->items); $i++)
		{
			$row = array_combine(['name', 'description', 'consist', 'weight', 'price', 'image'], $this->items[$i]);

			Salad::create($row);
		}
	}

}
