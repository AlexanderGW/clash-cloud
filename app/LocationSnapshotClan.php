<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationSnapshotClan extends Model
{
	public function clan() {
		return $this->belongsTo(Clan::class, 'clan_id', 'id');
	}

	public function location() {
		return $this->belongsTo(Location::class);
	}
}
