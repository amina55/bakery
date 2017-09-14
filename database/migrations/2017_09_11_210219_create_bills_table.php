<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');

            $table->string('bill_no', 100)->unique();
            $table->string('user_name', 100);
            $table->float('cgst_tax');
            $table->float('sgst_tax');
            $table->float('total_tax');
            $table->float('total_amount');
            $table->float('discount');
            $table->float('payable_amount');
            $table->float('paid_amount');

            $table->string('customer_name');
            $table->string('care_of');
            $table->string('customer_gstin_no');
            $table->boolean('status')->default(1);


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
        Schema::dropIfExists('bills');
    }
}
