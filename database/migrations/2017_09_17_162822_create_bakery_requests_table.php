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

            $table->unsignedInteger('stock_id');
            $table->unsignedInteger('quantity');
            $table->timestamp('demand_date');
            $table->timestamp('deliver_date')->nullable();
            $table->enum('status', ['approved', 'rejected', 'waiting'])->default('waiting');
            $table->enum('request_to', ['kitchen', 'store'])->default('kitchen');
            $table->string('rejection_reason')->nullable();
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('bakery_stocks')->onDelete('cascade');
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
