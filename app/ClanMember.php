<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClanMember extends Model
{
	public $timestamps = false;
	private static $location = null;

	public function snapshot() {
		return $this->belongsTo(ClanSnapshot::class, 'clan_snapshot_id')->with(['clan', 'badge', 'location']);
	}

	public function player() {
		return $this->belongsTo(Player::class, 'player_id');
	}

	public function ranking() {
		return $this->belongsTo(LocationSnapshotPlayer::class, 'player_id', 'player_id')->with('location');
	}

	/*public function isCoLeader() {
		return $this->role == 'C';
	}

	public function isElder() {
		return $this->role == 'E';
	}

	public function isLeader() {
		return $this->role == 'L';
	}

	public function isMember() {
		return $this->role == 'M';
	}*/

	/*public function getDonationRatio() {
		if($this->donations > 0 and $this->donations_received > 0) {
			if ($this->donations_received > $this->donations) {
				return '1:' . round($this->donations_received / $this->donations);
			} else {
				return round($this->donations / $this->donations_received) . ':1';
			}
		}
		return 0;
	}*/

	/*public function getLeague() {
		return League::getBadge( $this->in_league == 1 ? $this->trophies : 0 );
	}*/
}
