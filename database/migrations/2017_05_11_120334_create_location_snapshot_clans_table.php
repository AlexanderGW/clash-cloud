<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationSnapshotClansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_snapshot_clans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('location_id')->default(0);
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedInteger('clan_id')->default(0);
            $table->foreign('clan_id')->references('id')->on('clans');
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
        Schema::dropIfExists('location_snapshot_clans');
    }
}
