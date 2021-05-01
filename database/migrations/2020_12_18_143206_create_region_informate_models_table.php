<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionInformateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_informate_models', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->comment('Գլխավոր բաժին')->nullable();
            $table->string('slug')->nullable();
            $table->text('territory')->nullable();
            $table->text('agricultrual_land')->nullable();
            $table->text('total_population')->nullable();
            $table->text('urban')->nullable();
            $table->text('rural')->nullable();
            $table->text('total_workforce')->nullable();
            $table->text('employed')->nullable();
            $table->text('average_salary')->nullable();
            $table->text('specialization')->nullable();
            $table->text('success_case')->nullable();
            $table->text('agriculture')->nullable();
            $table->text('agriculture_comments')->nullable();
            $table->text('retail_trade')->nullable();
            $table->text('retail_trade_comments')->nullable();
            $table->text('construction')->nullable();
            $table->text('construction_comments')->nullable();
            $table->text('industry')->nullable();
            $table->text('industry_comments')->nullable();

            $table->foreign('parent_id', 'E_P_id_foreign')->references('id')->on('region_models')->onDelete('restrict')->onUpdate('cascade');

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
        Schema::dropIfExists('region_informate_models');
    }
}
