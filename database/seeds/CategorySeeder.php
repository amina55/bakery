<?php

use Illuminate\Database\Seeder;

use App\Category;
use App\Product;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::firstOrCreate([
            'name' => 'Cakes',
            'description' => 'This section is only for cakes.'
        ]);

        $products = ['Chiken Puff (PC)', 'Chocolate Cake Muffin', 'Chocochips Cake', 'Chocolate Barfi', 'Chocolate Mango Moose'];
        $prices  = [500, 1000, 600, 700, 300];

        $unitId = \App\Unit::getId('pound');

        for($i = 0; $i < count($products); $i++)
        {
            Product::firstOrCreate([
                'name' => $products[$i],
                'price' => $prices[$i],
                'category_id' => $category->id,
                'unit_id' => $unitId,
            ]);
        }

        $category = Category::firstOrCreate([
            'name' => 'Cookies',
            'description' => 'This section is for cookies.'
        ]);

        $products = ['Chocolate Roll (PC)', 'Chocolate Truffle Cake', 'Chocolate Truffle Pastry', 'Chocolate Truffle Barfi', 'Chocolates (kg)'];
        $prices  = [500, 1000, 600, 700, 300];


        for($i = 0; $i < count($products); $i++)
        {
            Product::firstOrCreate([
                'name' => $products[$i],
                'price' => $prices[$i],
                'category_id' => $category->id,
                'unit_id' => $unitId,
            ]);
        }

    }
}
