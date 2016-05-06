<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Trip;

class TripTableSeeder extends Seeder {

	public function run()
	{
		Model::unguard();
		Trip::create(['user_id' => '2', 'name' => 'My first trip', 'description' => 'YAYAYAYAYAYA']);
		Trip::create(['user_id' => '3', 'name' => 'Tests first trip', 'description' => 'seoigjoszdrgjrsg']);
		Trip::create(['user_id' => '3', 'name' => 'Tests second trip', 'description' => 'qwetyywerweyw']);
		
		Trip::create(['user_id' => '4', 'name' => 'Patricia first trip', 'description' => 'This is my first trip ! Im going to Nova Scotia']);
		Trip::create(['user_id' => '4', 'name' => 'Patricia second trip', 'description' => 'This is my second trip! Im going to japan']);
		Trip::create(['user_id' => '4', 'name' => 'Patricia third trip', 'description' => 'This is my third trip! Im going to LA']);
	}

}