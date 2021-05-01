<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageinnovationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pageinnovations', function (Blueprint $table) {
            $table->id();
            $table->string('page_img')->nullable();
            $table->string('page_img_mini')->nullable();
            $table->text('name');
            $table->string('slug')->nullable();

            $table->text('text_top')->nullable();
            $table->string('chart_text_top_id')->nullable();
           
            $table->text('text_middle_left')->nullable();
            $table->string('chart_text_middle_left_id')->nullable();
           
            $table->text('text_middle_right')->nullable();
            $table->string('chart_text_middle_right_id')->nullable();
            
            $table->text('text_bottom')->nullable();
            $table->string('chart_text_bottom_id')->nullable();
           

            $table->string('page_img_middle')->nullable();
            $table->text('meta_desc')->nullable();
            $table->text('keywords')->nullable();
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
        Schema::dropIfExists('pageinnovations');
    }
}
