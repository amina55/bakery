<?php

use Illuminate\Database\Seeder;
use App\RawItem;
use App\Unit;
class RawItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RawItem::firstOrCreate([
            'name' => 'sugar',
            'description' => 'Sugar for baking',
            'unit_id'  => Unit::getId('kg')
        ]);

        RawItem::firstOrCreate([
            'name' => 'pepsi',
            'description' => 'Drink',
            'unit_id'  => Unit::getId('liter')
        ]);

        RawItem::firstOrCreate([
            'name' => 'baking_powder',
            'description' => 'Baking Powder for making cake',
            'unit_id'  => Unit::getId('kg')
        ]);

        RawItem::firstOrCreate([
            'name' => 'cream',
            'description' => 'Cream for baking cake',
            'unit_id'  => Unit::getId('liter')
        ]);

        RawItem::firstOrCreate([
            'name' => 'milk',
            'description' => 'Milk for baking cake',
            'unit_id'  => Unit::getId('kg')
        ]);
    }
}
