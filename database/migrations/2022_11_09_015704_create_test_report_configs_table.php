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
        Schema::create('test_report_configs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_id');
            $table->unsignedBigInteger('report_test_id')->nullable();
            $table->unsignedBigInteger('test_template_id')->nullable();
            $table->string('report_test_name')->nullable();
            $table->integer('order')->default(0);
            $table->enum('section', ['header', 'body', 'footer'])->default('body');
            $table->integer('column')->nullable();
            $table->enum('component', ['text','div','span','label', 'image', 'table','multiline','select'])->default('text');
            $table->string('html')->nullable();
            $table->string('padding_top')->default('0');
            $table->string('padding_bottom')->default('0');
            $table->string('padding_left')->default('0');
            $table->string('padding_right')->default('0');
            $table->string('font_size')->default('1 rem');
            $table->string('font_weight')->default('normal');
            $table->string('font_style')->default('normal');
            $table->string('text_align')->default('left');
            $table->string('text_transform')->default('none');
            $table->string('text_decoration')->default('none');
            $table->string('color')->default('#000000');
            $table->string('background_color')->default('transparent');
            $table->string('border')->default('none');
            $table->string('border_top')->default('none');
            $table->string('border_bottom')->default('none');
            $table->string('border_left')->default('none');
            $table->string('border_right')->default('none');
            $table->string('border_radius')->default('none');
            $table->string('width')->default('100%');
            $table->string('height')->default('auto');
            $table->string('min_width')->default('auto');
            $table->string('min_height')->default('auto');
            $table->string('max_width')->default('auto');
            $table->string('max_height')->default('auto');
            $table->string('margin_top')->default('0');
            $table->string('margin_bottom')->default('0');
            $table->string('margin_left')->default('0');
            $table->string('margin_right')->default('0');
            $table->string('position')->default('relative');
            $table->string('display')->default('flex');
            $table->string('flex_direction')->default('row');
            $table->string('flex_wrap')->default('nowrap');
            $table->string('flex_justify')->default('flex-start');
            $table->string('flex_align')->default('stretch');
            $table->string('flex_align_content')->default('stretch');
            $table->string('flex_basis')->default('auto');
            $table->string('flex_grow')->default('0');
            $table->string('flex_shrink')->default('1');
            $table->string('flex_order')->default('0');
            $table->string('align_self')->default('auto');
            $table->string('z_index')->default('auto');
            $table->string('overflow')->default('visible');
            $table->string('overflow_x')->default('visible');
            $table->string('overflow_y')->default('visible');
            $table->string('float')->default('none');
            $table->string('clear')->default('none');

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
        Schema::dropIfExists('test_report_configs');
    }
};
