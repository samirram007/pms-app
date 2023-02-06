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
        Schema::create('referral_doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password')->default(bcrypt('password'));  
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('qualification')->nullable();
            $table->string('visiting_charge')->nullable();
            $table->string('availablility')->nullable()->comment('1=Available, 0=Not Available all other values are  allowed');
            $table->timestamp('email_verified_at')->nullable(); 
            $table->integer('contract_type_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('referral_doctors');
    }
};
