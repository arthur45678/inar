<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Ներդրողի կազմակերպություն
        Schema::create('investor_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users')
                // ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('company_name')->nullable();
            $table->text('program_name')->comment('Ծրագրի անունը')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_phone_1')->nullable();
            $table->string('company_phone_2')->nullable();
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
        Schema::dropIfExists('investor_companies');
    }
}
