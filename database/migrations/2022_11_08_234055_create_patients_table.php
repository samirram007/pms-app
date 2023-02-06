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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable()->unique();
            $table->string('code')->nullable();
            $table->string('multi_patient_id')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('password')->default(bcrypt('password'));
            $table->integer('lab_centre_id')->nullable(); // foreign key to lab_centers table
            $table->integer('referral_doctor_id')->nullable(); // foreign key to lab_centers table
            $table->integer('collection_centre_id')->nullable(); // foreign key to lab_centers table
            $table->string('address')->nullable();
            $table->string('age')->nullable();
            $table->date('dob')->nullable();
            $table->string('contact_no')->nullable();
            $table->enum('gender',['Male','Female','Others'])->default('Male')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('associate_id')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable(); 
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
        Schema::dropIfExists('patients');
    }
};
