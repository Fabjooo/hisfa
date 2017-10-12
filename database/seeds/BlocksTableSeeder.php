<?php

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
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

        DB::table('blocks')->truncate();

        $name = array(
            'P15',
            'P20',
            'P25',
            'P30',
            'P35',
            '100SE',
            '150SE',
            '200SE',
            '250SE',
        );

        for($i = 0; $i <= $limit; $i++){
            DB::table('blocks')->insert([
                'name' => $name[$i]
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
 }
