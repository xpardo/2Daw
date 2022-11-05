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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('review',255);
            $table->integer('rating');
            $table->timestamps();
        });

        Schema::table('review_useful', function (Blueprint $table) {
            $table->unsignedBigInteger('review_id')                  
                  ->nullable();
            $table->foreign('review_id')
                  ->references('id')->on('reviews')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('review_id')                  
                  ->nullable();
            $table->foreign('review_id')
                  ->references('id')->on('reviews')
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
        Schema::table('review_useful', function (Blueprint $table) {
            $table->dropForeign(['review_id']);
            $table->dropColumn('review_id');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign(['review_id']);
            $table->dropColumn('review_id');
        });
       
        Schema::dropIfExists('reviews');
    }
};
