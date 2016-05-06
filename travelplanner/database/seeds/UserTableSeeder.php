<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		Model::unguard();
		User::create(['name' => 'admin', 'email' => 'acdzlaravel@gmail.com', 'password' => bcrypt('Blackberry1!'),
			'profile_type' => 'Upscale Traveler', 'experience_level' => 'Experienced']);
		User::create(['name' => 'Chris Baur', 'email' => 'chriskbaur@gmail.com', 'password' => bcrypt('123456'),
			'profile_type' => 'Economy Traveler', 'experience_level' => 'Intermediate']);
		User::create(['name' => 'test', 'email' => 'test@gmail.com', 'password' => bcrypt('123456'),
			'profile_type' => 'Upscale Traveler', 'experience_level' => 'Experienced']);
		User::create(['name' => 'patricia', 'email' => 'patricia@gmail.com', 'password' => bcrypt('patricia'),
			'profile_type' => 'Comfort Traveler', 'experience_level' => 'Novice']);
	}

}
