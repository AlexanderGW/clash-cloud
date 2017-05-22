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
		$this->middleware('cors');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$player = \App\Player::where('tag', $request->tag)->first();
		if( !$player ) {
			abort(404);
		}

		$date = $request->date;
		if(is_null($date)) {
			$date = date('Y-m-d H:i:s');
		}

		$membership = $player->memberships()->with(['snapshot', 'ranking'])
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

		return view('player', $return);
	}
}