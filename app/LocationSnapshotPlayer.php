<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationSnapshotPlayer extends Model
{
	public function snapshot() {
		return $this->belongsTo(ClanSnapshot::class, 'clan_id', 'clan_id')->with(['clan', 'badge', 'location']);
	}

	public function clan() {
		return $this->belongsTo(Clan::class, 'clan_id', 'id');
	}
	
	public function location() {
		return $this->belongsTo(Location::class);
	}

	public function player() {
		return $this->belongsTo(Player::class, 'player_id', 'id');
	}

	public function getLeague() {
		return League::getBadge( $this->in_league == 1 ? $this->trophies : 0 );
	}
}
