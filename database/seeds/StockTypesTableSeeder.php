<?php

use Illuminate\Database\Seeder;

class StockTypesTableSeeder extends Seeder
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

        $types = ['f21MB-n','RF23W-n','KSE-20','KSE-30','F21B-n'];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        for($i = 0; $i < count($types); $i++){
            DB::table('stock_types')->insert([
                'type' => $types[$i],
                'stock_id' => $i+1,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
