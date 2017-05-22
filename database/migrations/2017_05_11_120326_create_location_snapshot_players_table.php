<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationSnapshotPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_snapshot_players', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('location_id')->default(0);
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedInteger('player_id')->default(0);
            $table->foreign('player_id')->references('id')->on('players');
            $table->unsignedInteger('clan_id')->nullable();
            $table->foreign('clan_id')->references('id')->on('clans');
            $table->tinyInteger('in_league')->unsigned()->default(0);
            $table->smallInteger('exp_level')->unsigned()->default(0);
            $table->smallInteger('trophies')->unsigned()->default(0);
            $table->smallInteger('attack_wins')->unsigned()->default(0);
            $table->smallInteger('defense_wins')->unsigned()->default(0);
            $table->smallInteger('rank')->unsigned()->default(0);
            $table->smallInteger('previous_rank')->default(0);
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
        Schema::dropIfExists('location_snapshot_players');
    }
}
