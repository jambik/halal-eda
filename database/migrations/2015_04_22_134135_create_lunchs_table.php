<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLunchsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lunchs', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users');

			$table->integer('meal1_id')->unsigned()->nullable();
			$table->foreign('meal1_id')->references('id')->on('meal1');

			$table->integer('meal2_id')->unsigned()->nullable();
			$table->foreign('meal2_id')->references('id')->on('meal2');

			$table->integer('garnish_id')->unsigned()->nullable();
			$table->foreign('garnish_id')->references('id')->on('garnishs');

			$table->integer('salad_id')->unsigned()->nullable();
			$table->foreign('salad_id')->references('id')->on('salads');

			$table->integer('drink_id')->unsigned()->nullable();
			$table->foreign('drink_id')->references('id')->on('drinks');

			$table->string('name');
			$table->string('description')->default('');
			$table->integer('price')->default(0);
			$table->string('image')->default('');

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('lunch_addition', function(Blueprint $table)
		{
			$table->integer('lunch_id')->unsigned()->index();
			$table->foreign('lunch_id')->references('id')->on('lunchs')->onDelete('cascade');

			$table->integer('addition_id')->unsigned()->index();
			$table->foreign('addition_id')->references('id')->on('additions')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lunchs');
		Schema::drop('lunch_addition');
	}

}
