<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagequalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagequalities', function (Blueprint $table) {
            $table->id();
            $table->string('page_img')->nullable();
            $table->string('page_img_mini')->nullable();
            $table->text('name');
            $table->string('slug')->nullable();
            $table->text('text_top')->nullable();
            $table->string('chart_text_top_id')->nullable();
           

            $table->text('text_bottom')->nullable();
            $table->string('chart_text_bottom_id')->nullable();
           
            $table->string('page_img_bottom')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('keywords')->nullable();

            $table->text('service_name_1')->nullable();
            $table->string('service_icon_symbol_1')->nullable();
            $table->string('service_price_1')->nullable();
            $table->text('service_name_2')->nullable();
            $table->string('service_icon_symbol_2')->nullable();
            $table->string('service_price_2')->nullable();
            $table->text('service_name_3')->nullable();
            $table->string('service_icon_symbol_3')->nullable();
            $table->string('service_price_3')->nullable();
            $table->text('service_name_4')->nullable();
            $table->string('service_icon_symbol_4')->nullable();
            $table->string('service_price_4')->nullable();
            $table->text('service_name_5')->nullable();
            $table->string('service_icon_symbol_5')->nullable();
            $table->string('service_price_5')->nullable();
            $table->text('service_name_6')->nullable();
            $table->string('service_icon_symbol_6')->nullable();
            $table->string('service_price_6')->nullable();
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
        Schema::dropIfExists('pagequalities');
    }
}
