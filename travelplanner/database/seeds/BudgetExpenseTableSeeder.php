<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\BudgetedExpense;

class BudgetExpenseTableSeeder extends Seeder {

	public function run()
	{
		/*, 'created_at' => '', 'updated_at' => '', 'planned_arrive' => '', 'planned_depart' =>'' */
		Model::unguard();
		BudgetedExpense::create(['location_id' => '1', 'trip_id' => '2', 'amount' => '100', 'description' => 'Budget one for location 1', 'category' => 'fun',
			'supplier' => 'myself', 'address' => 'CA', 'planned_arrive' => '2015-12-12 00:00:00', 'planned_depart' => '2015-12-13 00:00:00']);
		BudgetedExpense::create(['location_id' => '1', 'trip_id' => '3', 'amount' => '200', 'description' => 'Budget two for location 1', 'category' => 'too fun',
			'supplier' => 'herself', 'address' => 'FR', 'planned_arrive' => '2015-10-12 00:00:00', 'planned_depart' => '2015-10-13 00:00:00']);
		BudgetedExpense::create(['location_id' => '2', 'trip_id' => '3', 'amount' => '300', 'description' => 'Budget one for location 2', 'category' => 'three fun',
			'supplier' => 'theyself', 'address' => 'US', 'planned_arrive' => '2015-09-12 00:00:00', 'planned_depart' => '2015-09-13 00:00:00']);
		
		BudgetedExpense::create(['location_id' => '4', 'trip_id' => '4', 'amount' => '10', 'description' => 'Budget for gum', 'category' => 'extras',
			'supplier' => 'myyself', 'address' => 'CA', 'planned_arrive' => '2015-12-25 00:00:00', 'planned_depart' => '2015-12-25 00:00:00']);
		BudgetedExpense::create(['location_id' => '4', 'trip_id' => '4', 'amount' => '20', 'description' => 'Budget for tips', 'category' => 'tips',
			'supplier' => 'myyself', 'address' => 'CA', 'planned_arrive' => '2015-12-25 00:00:00', 'planned_depart' => '2015-12-25 00:00:00']);
		BudgetedExpense::create(['location_id' => '4', 'trip_id' => '4', 'amount' => '30', 'description' => 'Budget for Souvenirs', 'category' => 'souvenirs',
			'supplier' => 'myyself', 'address' => 'CA', 'planned_arrive' => '2015-12-12 00:00:00', 'planned_depart' => '2015-12-12 00:00:00']);
		BudgetedExpense::create(['location_id' => '4', 'trip_id' => '4', 'amount' => '40', 'description' => 'Budget for bar', 'category' => 'drinks',
			'supplier' => 'myyself', 'address' => 'CA', 'planned_arrive' => '2015-12-13 00:00:00', 'planned_depart' => '2015-12-13 00:00:00']);
		BudgetedExpense::create(['location_id' => '4', 'trip_id' => '4', 'amount' => '50', 'description' => 'Budget for food', 'category' => 'food',
			'supplier' => 'myyself', 'address' => 'CA', 'planned_arrive' => '2015-12-14 00:00:00', 'planned_depart' => '2015-12-14 00:00:00']);
		
		BudgetedExpense::create(['location_id' => '5', 'trip_id' => '5', 'amount' => '11', 'description' => 'Budget for gum 2', 'category' => 'extras',
			'supplier' => 'myyself', 'address' => 'JP', 'planned_arrive' => '2016-01-01 00:00:00', 'planned_depart' => '2016-01-01 00:00:00']);
		BudgetedExpense::create(['location_id' => '5', 'trip_id' => '5', 'amount' => '22', 'description' => 'Budget for tips 2', 'category' => 'tips',
			'supplier' => 'myyself', 'address' => 'JP', 'planned_arrive' => '2016-01-01 00:00:00', 'planned_depart' => '2016-01-01 00:00:00']);
		BudgetedExpense::create(['location_id' => '5', 'trip_id' => '5', 'amount' => '33', 'description' => 'Budget for Souvenirs 2', 'category' => 'souvenirs',
			'supplier' => 'myyself', 'address' => 'JP', 'planned_arrive' => '2015-09-12 00:00:00', 'planned_depart' => '2015-09-12 00:00:00']);
		BudgetedExpense::create(['location_id' => '5', 'trip_id' => '5', 'amount' => '44', 'description' => 'Budget for bar 2', 'category' => 'drinks',
			'supplier' => 'myyself', 'address' => 'JP', 'planned_arrive' => '2015-09-13 00:00:00', 'planned_depart' => '2015-09-13 00:00:00']);
		BudgetedExpense::create(['location_id' => '5', 'trip_id' => '5', 'amount' => '55', 'description' => 'Budget for food 2', 'category' => 'food',
			'supplier' => 'myyself', 'address' => 'JP', 'planned_arrive' => '2015-09-14 00:00:00', 'planned_depart' => '2015-09-14 00:00:00']);
		
		BudgetedExpense::create(['location_id' => '6', 'trip_id' => '6', 'amount' => '19', 'description' => 'Budget for gum 3', 'category' => 'extras',
			'supplier' => 'myyself', 'address' => 'US', 'planned_arrive' => '2015-10-13 00:00:00', 'planned_depart' => '2015-10-13 00:00:00']);
		BudgetedExpense::create(['location_id' => '6', 'trip_id' => '6', 'amount' => '29', 'description' => 'Budget for tips 3', 'category' => 'tips',
			'supplier' => 'myyself', 'address' => 'US', 'planned_arrive' => '2015-10-14 00:00:00', 'planned_depart' => '2015-10-14 00:00:00']);
		BudgetedExpense::create(['location_id' => '6', 'trip_id' => '6', 'amount' => '39', 'description' => 'Budget for Souvenirs 3', 'category' => 'souvenirs',
			'supplier' => 'myyself', 'address' => 'US', 'planned_arrive' => '2015-10-15 00:00:00', 'planned_depart' => '2015-10-15 00:00:00']);
		BudgetedExpense::create(['location_id' => '6', 'trip_id' => '6', 'amount' => '49', 'description' => 'Budget for bar 3', 'category' => 'drinks',
			'supplier' => 'myyself', 'address' => 'US', 'planned_arrive' => '2015-10-16 00:00:00', 'planned_depart' => '2015-10-16 00:00:00']);
		BudgetedExpense::create(['location_id' => '6', 'trip_id' => '6', 'amount' => '59', 'description' => 'Budget for food 3', 'category' => 'food',
			'supplier' => 'myyself', 'address' => 'US', 'planned_arrive' => '2015-10-17 00:00:00', 'planned_depart' => '2015-10-17 00:00:00']);
	}

}