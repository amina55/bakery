<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKitchenStocksInBakeryStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bakery_stocks', function (Blueprint $table) {
            $table->float('kitchen_quantity')->default(0);

        });

        Schema::table('bakery_requests', function (Blueprint $table) {
            $table->float('approve_quantity')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bakery_stocks', function (Blueprint $table) {
            $table->dropColumn('kitchen_quantity');
        });

        Schema::table('bakery_requests', function (Blueprint $table) {
            $table->dropColumn('approve_quantity');
        });
    }
}
