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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->string('password')->default(bcrypt('password'));
            $table->integer('lab_center_id')->nullable(); // foreign key to lab_centers table
            $table->integer('collection_center_id')->nullable(); // foreign key to lab_centers table
            $table->integer('department_id')->nullable(); // foreign key to departments table
            $table->integer('designation_id')->nullable(); // foreign key to designations table
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->double('salary')->nullable();
            $table->date('doj')->nullable();
            $table->date('dob')->nullable();
            $table->string('qualification')->nullable();
            $table->integer('contract_type_id')->default(3); // foreign key to contract_types table
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
        Schema::dropIfExists('employees');
    }
};
