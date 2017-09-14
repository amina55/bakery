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
        for ($i = 0; $i < 5; $i++) {
            Supplier::firstOrCreate([
                'name' => 'supplier'.$i,
                'address' => 'xyz, city abc, india',
                'phone_no' => '98877787868'.$i,
            ]);
        }
    }
}
