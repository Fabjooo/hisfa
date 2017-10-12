<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 2;
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        //
        for ($i = 0; $i <= $limit; $i++) {
            DB::table('users')->insert([ //,
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('admin'),
            ]);
        }

        // Admin
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@hisfa.be',
            'password' => bcrypt('admin'),
            'account_type' => 'admin',
        ]);

        // Tom
        DB::table('users')->insert([
            'name' => 'tom',
            'email' => 'tom@changeme.hisfa',
            'password' => bcrypt('hisfa'),
            'account_type' => 'admin',
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
