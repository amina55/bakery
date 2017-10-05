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
       // $this->call(UserSeeder::class);
      //  $this->call(UnitSeeder::class);
       // $this->call(RawItemsTableSeeder::class);
       // $this->call(SuppliersTableSeeder::class);
      //  $this->call(CategorySeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
