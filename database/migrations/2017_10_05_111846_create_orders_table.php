<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('order_no', 100)->unique();
            $table->string('user_name', 100);
            $table->float('cgst_tax');
            $table->float('sgst_tax');
            $table->float('total_tax');
            $table->float('total_amount');
            $table->float('discount');
            $table->float('payable_amount');
            $table->float('advance_paid');
            $table->float('paid_amount');
            $table->timestamp('delivery_date');

            $table->string('customer_name', 100)->nullable();
            $table->string('phone_no', 30)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('care_of', 30)->nullable();
            $table->string('customer_gstin_no', 30)->nullable();
            $table->boolean('status')->default(1);
            $table->enum('payment_type', ['cash', 'card']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
