<?php

use Illuminate\Database\Seeder;
use App\Customer;
class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::firstOrCreate([
            'name' => 'Sharetan',
            'gstin_no' => '01AAJFT7408E1ZG',
        ]);

        Customer::firstOrCreate([
            'name' => 'Barisata',
            'gstin_no' => '01AADCC9112H1Z6',
        ]);
    }
}
