<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contacts', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name')->default('');
			$table->string('phone')->default('');
			$table->string('city')->default('');
			$table->string('metro')->default('');
			$table->string('street')->default('');
			$table->string('house')->default('');
			$table->string('corpus')->default('');
			$table->string('building')->default('');
			$table->string('apartment')->default('');
			$table->string('entrance')->default('');
			$table->string('floor')->default('');
			$table->string('intercom')->default('');
			$table->string('comment')->default('');

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
		Schema::drop('contacts');
	}

}
