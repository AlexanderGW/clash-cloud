<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClanSnapshot extends Model
{
	public static $ranks = [];

	public function clan() {
		return $this->belongsTo(Clan::class);
	}

	public function badge() {
		return $this->belongsTo(Badge::class);
	}

	public function location() {
		return $this->belongsTo(Location::class);
	}

	public function members() {
		return $this->hasMany(ClanMember::class, 'clan_snapshot_id');
	}

	public function ranking() {
		return $this->belongsTo(LocationSnapshotClan::class, 'clan_id', 'clan_id')->with('location');
	}
}
