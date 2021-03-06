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
            $table->float('total_amount');
            $table->float('total_tax');
            $table->float('total_discount');
            $table->float('payable_amount');
            $table->float('paid_amount');
            $table->float('remaining');
            $table->unsignedInteger('supplier_id');
            $table->boolean('status')->default(1);

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
