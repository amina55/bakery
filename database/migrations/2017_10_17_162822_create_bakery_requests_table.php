<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBakeryRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bakery_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('stock_id')->nullable();
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('order_item_id')->nullable();
            $table->unsignedInteger('product_id');
            $table->float('weight');
            $table->float('quantity');
            $table->float('approve_quantity')->default(0);
            $table->timestamp('demand_date');
            $table->timestamp('deliver_date')->nullable();
            $table->enum('status', ['approved', 'rejected', 'waiting', 'working'])->default('waiting');
            $table->enum('request_to', ['kitchen', 'store'])->default('kitchen');
            $table->string('rejection_reason', 100)->nullable();
            $table->string('special_note', 100)->nullable();

            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('bakery_stocks')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bakery_requests');
    }
}
