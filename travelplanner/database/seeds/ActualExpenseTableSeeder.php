<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\ActualExpense;

class ActualExpenseTableSeeder extends Seeder {

	public function run()
	{
		Model::unguard();
		
		ActualExpense::create(['budgeted_id' => '4', 'amount' => '10', 'description' => 'actual for gum', 'category' => 'extras',
			'supplier' => 'myyself', 'address' => 'CA', 'actual_arrive' => '2015-12-25 00:00:00', 'actual_depart' => '2015-12-25 00:00:00']);
		ActualExpense::create(['budgeted_id' => '5', 'amount' => '20', 'description' => 'actual for tips', 'category' => 'tips',
			'supplier' => 'myyself', 'address' => 'CA', 'actual_arrive' => '2015-12-25 00:00:00', 'actual_depart' => '2015-12-25 00:00:00']);
		
		ActualExpense::create(['budgeted_id' => '9', 'amount' => '11', 'description' => 'actual for gum 2', 'category' => 'extras',
			'supplier' => 'myyself', 'address' => 'JP', 'actual_arrive' => '2016-01-01 00:00:00', 'actual_depart' => '2016-01-01 00:00:00']);
		ActualExpense::create(['budgeted_id' => '10', 'amount' => '22', 'description' => 'actual for tips 2', 'category' => 'tips',
			'supplier' => 'myyself', 'address' => 'JP', 'actual_arrive' => '2016-01-01 00:00:00', 'actual_depart' => '2016-01-01 00:00:00']);
			
		ActualExpense::create(['budgeted_id' => '6', 'amount' => '30', 'description' => 'actual for souvenirs', 'category' => 'souvenirs',
		'supplier' => 'myyself', 'address' => 'CA', 'actual_arrive' => '2015-12-21 00:00:00', 'actual_depart' => '2015-21-25 00:00:00']);
		ActualExpense::create(['budgeted_id' => '11', 'amount' => '33', 'description' => 'actual for souvenirs 2', 'category' => 'souvenirs',
		'supplier' => 'myyself', 'address' => 'CA', 'actual_arrive' => '2015-12-21 00:00:00', 'actual_depart' => '2015-21-25 00:00:00']);
		
	}

}