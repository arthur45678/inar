<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFildsToRegionInformateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('region_informate_models', function (Blueprint $table) {
            $table->text('tourism')->nullable();
            $table->text('cropproduction')->nullable();
            $table->text('portable_energy')->nullable();
            $table->text('food_processing')->nullable();
            $table->text('beverage_production')->nullable();
            $table->text('textile')->nullable();
            $table->text('field_1')->nullable();
            $table->text('field_2')->nullable();
            $table->text('field_3')->nullable();
            $table->text('field_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('region_informate_models', function (Blueprint $table) {
            //
        });
    }
}
