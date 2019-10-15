<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('points');
            $table->bigInteger('rank')->nullable();
            $table->unsignedBigInteger('player_id');
            $table->timestamps();
            $table->foreign('player_id')->references('id')->on('players');
        });
    }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('points');
        }
}
