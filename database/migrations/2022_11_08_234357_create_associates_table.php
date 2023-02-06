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
        Schema::create('associates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('password')->default(bcrypt('password'));
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->integer('contract_type_id')->default(2);
            $table->double('commission')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('lab_centre_id')->nullable();
            $table->bigInteger('collection_centre_id')->nullable();
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
        Schema::dropIfExists('associates');
    }
};
