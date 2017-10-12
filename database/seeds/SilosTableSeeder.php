<?php

use Illuminate\Database\Seeder;

class SilosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$faker = Faker\Factory::create();
		
		$limit = 8;
		
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		DB::table('silos')->truncate();

		for($i = 0; $i <= $limit; $i++){

			DB::table('silos')->insert([
				'number' => $i+1,
				'volume' => $faker->numberBetween($min = 1, $max = 100),
                'updated_at' => $faker->dateTimeThisDecade($max = 'now'),
            ]);
		}
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}