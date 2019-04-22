<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CourseSeeder extends Seeder
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
        DB::table('courses')->insert([
          'course_name' => $faker->title,
          'duration' => $faker->numberBetween(1,3),
          'description' => $faker->text
        ]);

      }
    }
}
