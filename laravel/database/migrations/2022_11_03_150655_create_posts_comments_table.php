<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('title');
            $table->text('body');
            $table->float('latitude');
            $table->float('longitude');
            $table->text('nombre');
            $table->string('files', 255);
            $table->timestamps();
            $table->softDeletes();
        });
   
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')                  
                  ->nullable();
            $table->foreign('post_id')
                  ->references('id')->on('posts')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
        Schema::table('post_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')                  
                  ->nullable();
            $table->foreign('post_id')
                  ->references('id')->on('posts')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')                  
                  ->nullable();
            $table->foreign('post_id')
                  ->references('id')->on('posts')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
        
        
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');
        });
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropColumn('post_id');
        });
       
        Schema::dropIfExists('posts');
        Schema::dropIfExists('comments');
    }
};
