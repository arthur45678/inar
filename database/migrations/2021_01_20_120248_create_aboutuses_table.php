<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('aboutuses', function (Blueprint $table) {
            $table->id();
            $table->text('f_name');
            $table->text('l_name');
            $table->text('position')->comment('Должность')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('img')->nullable();
            $table->string('slug')->nullable();
            $table->text('short_desc')->comment('Կարճ բնութագիրը, գործունեությունը')->nullable();

            $table->unsignedBigInteger('department_id')->comment('Բաժանմունք')->nullable();
            $table->foreign('department_id')->references('id')->on('employeedepartments');

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
        Schema::dropIfExists('aboutuses');
    }
}
