<?php

use Illuminate\Database\Seeder;
use App\User;

class SupportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          //Support - Prject 1
        User::create([ //3
        	'name' => 'Soporte S1',
        	'email' => 'support@gmail.com',
        	'password' => bcrypt('123456'),
        	'role' => 1	
        ]);
        User::create([ //4
        	'name' => 'Soporte S2',
        	'email' => 'support2@gmail.com',
        	'password' => bcrypt('123456'),
        	'role' => 1	
        ]);
    }
}
