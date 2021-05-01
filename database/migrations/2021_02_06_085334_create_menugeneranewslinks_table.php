<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenugeneranewslinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menugeneranewslinks', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('img')->nullable();

            $table->text('desc')->nullable();
            $table->text('link')->nullable();
            $table->string('lang');

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
        Schema::dropIfExists('menugeneranewslinks');
    }
}

