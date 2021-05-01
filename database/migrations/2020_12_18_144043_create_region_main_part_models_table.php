<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionMainPartModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_main_part_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->comment('Գլխավոր բաժին')->nullable();
            $table->string('slug')->nullable();
            $table->text('weather')->nullable();
            $table->text('region_center_title')->nullable();
            $table->text('region_center_info')->nullable();
            $table->text('region_center_other')->nullable();
            $table->text('average_prices')->nullable();
            $table->text('average_other')->nullable();
            $table->text('Georgia')->nullable();
            $table->text('Yerevan')->nullable();
            $table->text('Iran')->nullable();

            $table->foreign('parent_id')->references('id')->on('region_models')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('region_main_part_models');
    }
}
