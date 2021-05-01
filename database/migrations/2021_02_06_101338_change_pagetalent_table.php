<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePagetalentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagetalent', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagetalent', function (Blueprint $table) {
            $table->string('chart_text_top_id')->nullable();
            
            $table->string('chart_text_middle_id')->nullable();
           
            $table->string('chart_text_bottom_id')->nullable();
            
        });
    }
}
