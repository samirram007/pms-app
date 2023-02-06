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
        Schema::create('sales_invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_no')->nullable();
            $table->dateTime('payment_date')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('sales_invoice_id')->nullable();
            $table->integer('lab_centre_id')->nullable();
            $table->integer('collection_centre_id')->nullable();
            $table->decimal('amount')->nullable();
            $table->integer('payment_mode_id')->nullable();
            $table->boolean('is_confirm')->default(false);
            $table->string('payer_name')->nullable();
            $table->string('card_number')->nullable(); 
            $table->string('tid')->nullable(); 
            $table->string('transaction_number')->nullable(); 
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
        Schema::dropIfExists('sales_invoice_payments');
    }
};
