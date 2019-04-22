<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 5; $i++){

    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('users')->insert([
          'name' => $faker->name,
          'email' => $faker->freeEmail,
          'password' => $faker->md5('123')
    		]);

    	}

    }
}
