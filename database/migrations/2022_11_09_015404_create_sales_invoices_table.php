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
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->dateTime('invoice_date')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('associate_id')->nullable();
            $table->integer('referral_doctor_id')->nullable();
            $table->integer('lab_centre_id')->nullable();
            $table->integer('collection_centre_id')->nullable();
            $table->decimal('item_total')->nullable();
            $table->integer('item_count')->nullable();
            $table->integer('discount_type_id')->nullable();
            $table->decimal('discount_amount')->nullable();
            $table->decimal('discounted_amount')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('total_amount')->nullable();
            $table->integer('payment_mode_id')->default(1);
            $table->decimal('paid_amount')->nullable();
            $table->decimal('due_amount')->nullable(); // total_amount - paid_amount
            $table->integer('invoice_status_id')->default(1); // 1 = pending, 2 = paid, 3 = partialy paid, 4 = cancelled);  
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
        Schema::dropIfExists('sales_invoices');
    }
};
