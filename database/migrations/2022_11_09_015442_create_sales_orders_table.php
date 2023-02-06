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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->nullable();
            $table->dateTime('order_date')->nullable();
            $table->integer('patient_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('associate_id')->nullable();
            $table->integer('associate_doctor_id')->nullable();
            $table->integer('lab_centre_id')->nullable();
            $table->integer('collection_centre_id')->nullable();
            $table->decimal('cost')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('total')->nullable();
            $table->integer('order_status_id')->nullable();
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
        Schema::dropIfExists('sales_orders');
    }
};
