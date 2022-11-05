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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->unsignedBigInteger('tag_id') ;
            $table->timestamps();
        });
        Schema::table('post_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id')                  
                  ->nullable();
            $table->foreign('tag_id')
                  ->references('id')->on('tags')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->unsignedBigInteger('tag_id')                  
                  ->nullable();
            $table->foreign('tag_id')
                  ->references('id')->on('tags')
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
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropColumn('tag_id');
        });
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
            $table->dropColumn('tag_id');
        });
        Schema::dropIfExists('tags');
    }
};
