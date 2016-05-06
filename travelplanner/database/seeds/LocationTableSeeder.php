<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Location;

class LocationTableSeeder extends Seeder {

	public function run()
	{
		Model::unguard();
		Location::create(['name' => 'Montreal', 'description' => 'Going back to montreal', 'city' => 'Montreal',
			'province' => 'Quebec', 'country_code' => 'CA']);
		Location::create(['name' => 'Paris', 'description' => 'Going to paris for the first time', 'city' => 'Paris',
			'province' => 'France', 'country_code' => 'FR']);
		Location::create(['name' => 'San Francisco', 'description' => 'Going to somewhere in cali.', 'city' => 'San Francisco',
			'province' => 'California', 'country_code' => 'US']);
			
		Location::create(['name' => 'Nova Scotia', 'description' => 'All of Nova Scotia', 'city' => 'Cape Breton',
			'province' => 'Nova Scotia', 'country_code' => 'CA']);
		Location::create(['name' => 'Japan', 'description' => 'All of Japan', 'city' => 'Tokyo',
			'province' => 'Japan', 'country_code' => 'JP']);
		Location::create(['name' => 'Los Angeles', 'description' => 'All of Los Angeles', 'city' => 'San Francisco',
			'province' => 'California', 'country_code' => 'US']);
	}

}