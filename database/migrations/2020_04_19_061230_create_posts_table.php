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
            $table->increments('id');
            $table->string('title',255);
            $table->string('slug');
            $table->text('body');
            $table->text('excerpt');
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->integer('posted_by')->nullable();
            $table->string('image')->nullable();
            $table->string('comment_count')->nullable();
            $table->string('post_views')->nullable();
            $table->string('like')->nullable();
            $table->string('dislike')->nullable();
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
