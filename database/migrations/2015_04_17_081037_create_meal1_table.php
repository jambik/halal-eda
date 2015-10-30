<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeal1Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meal1', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name');
			$table->string('description')->default('');
			$table->string('consist')->default('');
			$table->string('weight')->default('');
			$table->integer('price')->default(0);
			$table->string('image')->default('');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meal1');
	}

}
