<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerGamesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_games', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('player_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->tinyInteger('channel')->unsigned();
            $table->smallInteger('version')->unsigned();
            $table->boolean('is_hack')->default(false);
            
            $table->timestamps();

            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('player_games');
    }

}
