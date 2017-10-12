<?php

use Illuminate\Database\Seeder;

class SiloTypesTableSeeder extends Seeder
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
        for($i = 0; $i <= $limit; $i++){

            $type = ( $i > 5 ) ? 'waste' : 'prime';

            DB::table('silo_types')->insert([
                'type' => $type,
                'silo_id' => $i+1,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
