<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_invoice_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->integer('is_package')->default(0); // 0 = test, 1 = package
            $table->decimal('test_cost')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('amount')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('amount_weightage')->default(0); // based on the testor package weightage(%) from total_invoice_amount
            $table->decimal('discount_percentage')->default(0); // based on the testor package weightage(%) from total_invoice_amount
            $table->integer('test_status_id')->deafult(1); // 1 = pending, 2 = completed, 3 = cancelled
            $table->text('test_log')->nullable();
            $table->date('test_date')->nullable();
            $table->date('report_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('is_cancelled')->nullable();
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
        Schema::dropIfExists('sales_invoice_items');
    }
};
