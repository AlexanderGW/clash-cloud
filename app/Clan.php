<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
	public function snapshots() {
		return $this->hasMany(ClanSnapshot::class);
	}

	public function ranks() {
		return $this->hasMany(LocationSnapshotClan::class);
	}

	public function getSnapshotOn($date = null) {
		if(is_null($date)) {
			$date = date('Y-m-d');
		}

		try {
			$d = Carbon::createFromFormat('Y-m-d', $date);
		}
		catch(\InvalidArgumentException $e) {
			return;
		}

		$snapshot = ClanSnapshot::where([
			['clan_id', $this->id]
		])->with(['badge', 'ranking' => function($query) use ($d){
			return $query->whereBetween('updated_at', [
				$d->format('Y-m-d'),
				$d->addDay()->format('Y-m-d')
			])->orderBy('updated_at', 'desc');
		}])
		->whereBetween('updated_at', [$d->format('Y-m-d') . ' 00:00:00', $d->addDay()->format('Y-m-d')])
		->orderBy('updated_at', 'desc')
		->first();

		return $snapshot;
	}

	public function getSnapshotBefore($date = null) {
		if(is_null($date)) {
			$date = date('Y-m-d H:i:s');
		}

		try {
			$d = Carbon::createFromFormat('Y-m-d H:i:s', $date);
		}
		catch(\InvalidArgumentException $e) {
			return;
		}

		$snapshot = ClanSnapshot::where([
			['clan_id', $this->id]
		])->with(['badge', 'ranking' => function($query) use ($d){
			return $query->whereBetween('updated_at', [
				$d->format('Y-m-d'),
				$d->addDay()->format('Y-m-d')
			])->orderBy('updated_at', 'desc');
		}])
		->where('updated_at', '<', $d->format('Y-m-d H:i:s'))
		->orderBy('updated_at', 'desc')
		->first();

		return $snapshot;
	}
}
