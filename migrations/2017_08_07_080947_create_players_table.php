<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');

            $table->string('facebook_id', 128)->nullable();
            $table->string('gamecenter_id', 128)->nullable();
            $table->string('playgames_id', 128)->nullable();
            $table->string('udid', 128);
            $table->string('name', 128)->nullable;
            $table->string('ip', 15);
            
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
        Schema::drop('players');
    }

}
