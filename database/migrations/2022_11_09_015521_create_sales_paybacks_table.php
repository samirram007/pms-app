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
        Schema::create('sales_paybacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_invoice_id');
            $table->integer('lab_centre_id')->nullable();
            $table->integer('collection_centre_id')->nullable();
            $table->dateTime('sales_payback_date')->default(now());
            $table->string('sales_payback_number')->nullable();
            $table->decimal('amount', 10, 2); 
            $table->string('sales_payback_note')->nullable();
            $table->string('sales_payback_status')->default('paid');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('sales_paybacks');
    }
};
