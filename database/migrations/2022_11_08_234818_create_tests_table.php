<?php

use App\Models\TestGroup;
use App\Models\TestCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('alias')->nullable();
            $table->string('code')->nullable();
            $table->boolean('is_package')->default(false);
            $table->text('description')->nullable();
            $table->decimal('cost')->nullable();
            $table->decimal('amount')->nullable();
            $table->decimal('discount')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('tag')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();

            $table->foreignIdFor(TestGroup::class)->nullable();
            $table->foreignIdFor(TestCategory::class)->nullable();
            $table->boolean('has_method')->default(true);
            $table->integer('test_unit_id')->nullable();
            $table->string('specimen_type')->nullable();
            $table->string('test_method')->nullable();
            $table->string('test_method_description')->nullable();
            $table->string('reference_range')->nullable();
            $table->boolean('inhouse_test')->default(true);
            $table->string('test_value')->nullable();
            $table->integer('test_duration')->default(0); // in days
            $table->text('preparation')->nullable();
            $table->text('instructions')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->integer('reporting_template_id')->nullable();
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
        Schema::dropIfExists('tests');
    }
};
