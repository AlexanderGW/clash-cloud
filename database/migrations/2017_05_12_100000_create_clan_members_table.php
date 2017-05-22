<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClanMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clan_members', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('clan_snapshot_id')->default(0);
            $table->foreign('clan_snapshot_id')->references('id')->on('clan_snapshots');
            $table->unsignedInteger('player_id')->default(0);
            $table->foreign('player_id')->references('id')->on('players');
            $table->unsignedTinyInteger('in_league')->default(0);
            $table->enum('role', array('C', 'E', 'L', 'M'))->default('M');
            $table->smallInteger('exp_level')->unsigned()->default(0);
            $table->smallInteger('trophies')->unsigned()->default(0);
            $table->tinyInteger('rank')->unsigned()->default(0);
            $table->tinyInteger('previous_rank')->unsigned()->default(0); //TODO: TBR
            $table->smallInteger('donations')->unsigned()->default(0);
            $table->smallInteger('donations_received')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clan_members');
    }
}
