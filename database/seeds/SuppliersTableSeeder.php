<?php

use Illuminate\Database\Seeder;
use App\Supplier;
class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::firstOrCreate([
            'identifier' => str_random('5'),
            'name' => str_random('10'),
            'address' => 'xyz, city abc, india',
            'phone_no' => '98877787868'
        ]);

        Supplier::firstOrCreate([
            'identifier' => str_random('5'),
            'name' => str_random('10'),
            'address' => 'xyz, city abc, india',
            'phone_no' => '98877787868'
        ]);

        Supplier::firstOrCreate([
            'identifier' => str_random('5'),
            'name' => str_random('10'),
            'address' => 'xyz, city abc, india',
            'phone_no' => '98877787868'
        ]);

        Supplier::firstOrCreate([
            'identifier' => str_random('5'),
            'name' => str_random('10'),
            'address' => 'xyz, city abc, india',
            'phone_no' => '98877787868'
        ]);

    }
}
