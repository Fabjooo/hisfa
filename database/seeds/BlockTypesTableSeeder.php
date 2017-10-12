<?php

use Illuminate\Database\Seeder;

class BlockTypesTableSeeder extends Seeder
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

        $types = ['P15','60SE','P20','100SE','P25','150SE','P30','200SE','P35','250SE'];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        for($i = 0; $i <= count($types)-1; $i++){
            DB::table('block_types')->insert([
                'type' => $types[$i],
                'block_id' => $i+1,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
