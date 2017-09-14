<?php

use Illuminate\Database\Seeder;
use App\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::firstOrCreate([
            'name' => 'kilogram',
            'short_key' => 'kg',
        ]);

        Unit::firstOrCreate([
            'name' => 'liter',
            'short_key' => 'liter',
        ]);

        Unit::firstOrCreate([
            'name' => 'mile liter',
            'short_key' => 'ml',
        ]);

        Unit::firstOrCreate([
            'name' => 'pound',
            'short_key' => 'pound',
        ]);
    }
}
