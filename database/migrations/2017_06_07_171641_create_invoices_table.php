<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_invoice_id', 50)->unique();
            $table->timestamp('date');
            $table->integer('total_amount');
            $table->integer('total_tax');
            $table->integer('total_discount');
            $table->integer('payable_amount');
            $table->integer('paid_amount');
            $table->integer('remaining');
            $table->unsignedInteger('supplier_id');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
