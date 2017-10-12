<?php

use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
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
		$limit = 10;
		
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		DB::table('stocks')->truncate();


		for($i = 0; $i <= $limit; $i++){
			DB::table('stocks')->insert([
				'tonnage' => $faker->numberBetween($min = 1, $max = 15),
				'image' => $faker->imageUrl($width = 640, $height = 480),
			]);
		}
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
