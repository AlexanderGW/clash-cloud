<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//$this->middleware('cors');
	}

	/**
	 * Player overview.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$player = \App\Player::where('tag', $request->tag)->first();
		if( !$player ) {
			abort(404);
		}

		$membership = $player->memberships()->with(['snapshot' => function($query) {
			return $query->orderBy('updated_at', 'desc')->first();
		}, 'ranking'])
		->orderBy('clan_members.id', 'desc')->first();

		$rank = $player->rankings()->with(['snapshot', 'location'])
		->orderBy('location_snapshot_players.updated_at', 'desc')->first();

		if( !$membership and !$rank ) {
			abort(404);
		}

		//var_dump( $membership->snapshot()->get() );

		$return = [
				'player' => $player,
				'membership' => $membership,
				'rank' => $rank
		];

		return response()->json($return);
		//return view('player', $return);
	}

	/**
	 * Player history feed.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function history(Request $request) {
		$player = \App\Player::where('tag', $request->tag)->first();
		if( !$player ) {
			abort(404);
		}

		$memberships = $player->memberships()->orderBy('id', 'desc');

		/*$clans = \App\ClanSnapshot::select('clans.tag', 'clans.name', 'clan_snapshots.updated_at')
        ->join('clans', 'clans.id', '=', 'clan_snapshots.clan_id')
        ->whereIn('clan_snapshots.id', $memberships->pluck('clan_snapshot_id'))
        ->distinct()->get()->toArray();*/

		$clans = \App\ClanSnapshot::with(['clan', 'badge'])
		->whereIn('id', $memberships->pluck('clan_snapshot_id'))
		->distinct()->get()->toArray();

		foreach ($clans as $key => $val) {
			$clans[$key]['type'] = 'C';
		}

		var_dump($clans);exit;

		$return = [
			$clans
		];

		return response()->json($return);
	}
}