<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('info_id');
            $table->unsignedBigInteger('comment_id');
            $table->longText('comment_answer')->nullable();            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('info_id')->references('id')->on('new_informations')->onDelete('CASCADE');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('CASCADE');
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
        Schema::dropIfExists('comment_answers');
    }
}
