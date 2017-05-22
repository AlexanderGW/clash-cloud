<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	public function clans() {
		return $this->hasMany(LocationSnapshotClan::class);
	}

	public function players() {
		return $this->hasMany(LocationSnapshotPlayer::class);
	}
}
