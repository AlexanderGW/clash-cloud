<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClanSnapshotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clan_snapshots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('badge_id')->default(0);
            $table->foreign('badge_id')->references('id')->on('badges');
            $table->unsignedInteger('clan_id')->default(0);
            $table->foreign('clan_id')->references('id')->on('clans');
            $table->unsignedInteger('location_id')->default(0);
            $table->foreign('location_id')->references('id')->on('locations');
            $table->enum('state', array('C', 'I', 'O'))->default('I');
            //$table->enum('war_frequency', array('A', '', 'L', 'M'))->default('M');
            $table->smallInteger('war_wins')->unsigned()->default(0);
            $table->smallInteger('war_wins_streak')->unsigned()->default(0);
            $table->smallInteger('points')->unsigned()->default(0);
            $table->smallInteger('required_points')->unsigned()->default(0);
            $table->tinyInteger('level')->unsigned()->default(1);
            //$table->tinyInteger('total_members')->unsigned()->default(0);
            $table->char('description', 255)->nullable();
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
        Schema::dropIfExists('clan_snapshots');
    }
}
