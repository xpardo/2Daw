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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('description',255);
            $table->float('latitude:');
            $table->float('longitude');
            $table->timestamps();
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('place_id')                  
                  ->nullable();
            $table->foreign('place_id')
                  ->references('id')->on('places')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('place_id')                  
                  ->nullable();
            $table->foreign('place_id')
                  ->references('id')->on('places')
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
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['place_id']);
            $table->dropColumn('place_id');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->dropForeign(['place_id']);
            $table->dropColumn('place_id');
        });
        Schema::dropIfExists('places');
    }
};
