<?php

use Illuminate\Database\Seeder;
use App\RawItem;

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
            'unit'  => 'kg'
        ]);

        RawItem::firstOrCreate([
            'name' => 'pepsi',
            'description' => 'Drink',
            'unit'  => 'litre'
        ]);

        RawItem::firstOrCreate([
            'name' => 'baking_powder',
            'description' => 'Baking Powder for making cake',
            'unit'  => 'kg'
        ]);

        RawItem::firstOrCreate([
            'name' => 'cream',
            'description' => 'Cream for baking cake',
            'unit'  => 'litre'
        ]);

        RawItem::firstOrCreate([
            'name' => 'milk',
            'description' => 'Milk for baking cake',
            'unit'  => 'kg'
        ]);
    }
}
