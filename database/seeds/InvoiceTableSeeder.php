<?php

use Illuminate\Database\Seeder;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         *
         UPDATE `bill_items` JOIN products ON bill_items.product_id = products.id  SET bill_items.category_id= products.category_id

         UPDATE `bakery_stocks` JOIN products ON bakery_stocks.product_id = products.id  SET bakery_stocks.category_id= products.category_id
        */
    }
}
