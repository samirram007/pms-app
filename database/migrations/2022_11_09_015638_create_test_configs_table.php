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
        Schema::create('test_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('test_id');
            $table->integer('test_unit_id')->nullable();
            $table->integer('test_group_id')->nullable();
            $table->integer('test_category_id')->nullable();
            $table->integer('specimen_id')->nullable();
            $table->integer('test_method_id')->nullable();
            $table->text('test_method_description')->nullable();
            $table->string('reference_range')->nullable();
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
        Schema::dropIfExists('test_configs');
    }
};
