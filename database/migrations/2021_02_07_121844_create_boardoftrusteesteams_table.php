<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardoftrusteesteamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boardoftrusteesteams', function (Blueprint $table) {
            $table->id();
            $table->text('f_name');
            $table->text('l_name');
            $table->text('position')->comment('Должность')->nullable();
            $table->text('position_1')->comment('Должность 1')->nullable();
            $table->text('position_2')->comment('Должность 2')->nullable();
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
        Schema::dropIfExists('boardoftrusteesteams');
    }
}
