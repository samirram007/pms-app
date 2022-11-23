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
        Schema::create('test_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('specimen_type')->nullable();
            $table->string('test_method')->nullable();
            $table->string('test_method_description')->nullable();
            $table->string('reference_range')->nullable();
            $table->boolean('inhouse_test')->nullable();
            $table->string('test_value')->nullable();
            $table->integer('test_group_id')->nullable();
            $table->boolean('has_method')->default(false);
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
        Schema::dropIfExists('test_categories');
    }
};
