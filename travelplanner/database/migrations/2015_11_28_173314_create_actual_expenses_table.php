<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActualExpensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actual_expenses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('budgeted_id')->unsigned();
			$table->foreign('budgeted_id')->references('id')->on('budgeted_expenses');
			$table->bigInteger('amount');
			$table->string('description');
			$table->string('category');
			$table->string('supplier');
			$table->string('address');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('actual_expenses');
	}

}
