<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserTableSeeder::class);
		$this->call(SilosTableSeeder::class);
        $this->call(SiloContentsTableSeeder::class);
        $this->call(SiloTypesTableSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(BlockLengthsTableSeeder::class);
        $this->call(BlockTypesTableSeeder::class);
        $this->call(StocksTableSeeder::class);
        $this->call(StockCountsTableSeeder::class);
        $this->call(StockTypesTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
