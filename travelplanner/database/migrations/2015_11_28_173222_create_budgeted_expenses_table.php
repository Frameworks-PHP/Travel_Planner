<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetedExpensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('budgeted_expenses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('location_id')->unsigned();
			$table->foreign('location_id')->references('id')->on('locations');
			$table->integer('trip_id')->unsigned();
			$table->foreign('trip_id')->references('id')->on('trips');
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
		Schema::drop('budgeted_expenses');
	}

}
