<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->nullable();
            $table->text('desc')->nullable();
            $table->text('text')->nullable();

            $table->string('chart_text_top_id')->nullable();
           

            $table->longText('meta_desc')->nullable();
            $table->longText('keywords')->nullable();

            $table->string('img')->nullable();
            $table->string('img_mini')->nullable();
            $table->boolean('publish')->default(true);
            $table->integer('view_count')->default(0);

            $table->unsignedBigInteger('user_id')->unsigned()->default(1);
            $table->foreign('user_id')->references('id')->on('users')
               // ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string("posts_type")->comment('Тип поста');
            $table->timestamp('event_started_date')->comment('Միջոցառումը սկսվել է')->nullable();
            $table->date('event_finished_date')->comment('Միջոցառումը ավրտվում է')->nullable();
            $table->timestamps();
        });

        Schema::create('posts_tags', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('post_id')->unsigned()->default(1);
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('tag_id')->unsigned()->default(1)->nullable();
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('posts_categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('post_id')->unsigned()->default(1);
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->unsignedBigInteger('category_id')->unsigned()->default(1);
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('posts');
    }
}
