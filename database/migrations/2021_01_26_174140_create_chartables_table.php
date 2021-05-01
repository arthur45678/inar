<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chartables', function (Blueprint $table) {
            $table->id();
            $table->integer("chart_id");
            $table->integer("chartable_id");
            $table->string("chartable_type");
            $table->string("post_position")->comment('Չուցադրել որ հատվածում')->default(\App\Models\Chart::POSITION_TOP);

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
        Schema::dropIfExists('chartables');
    }
}
