<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//Admin
		User::create([
			'name' => 'Jorge',
			'email' => 'jorge@gmail.com',
			'password' => bcrypt('799797'),
			'role' => 0,
		]);

		//Client
		User::create([
			'name' => 'Mary',
			'email' => 'client@gmail.com',
			'password' => bcrypt('123456'),
			'role' => 2,
		]);

	}
}
