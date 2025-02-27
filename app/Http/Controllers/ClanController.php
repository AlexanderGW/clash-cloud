<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClanController extends Controller
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
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {

		$clan = \App\Clan::where('tag', $request->tag)->first();
		if(!$clan) {
			abort(404);
		}

		$return = [
			'clan' => $clan
		];


		// Get most recent snapshot for the day
		$current = $clan->getSnapshotBefore($request->date);

		// Get the snapshot before "current"
		if ($current) {
			$return['csc'] = $current;

			// Current members
			$return['csmc'] = $current->members()->with(['player', 'ranking' => function($query) use($current){
				return $query->whereBetween('updated_at', [
					$current->updated_at->format('Y-m-d'), $current->updated_at->addDay()->format('Y-m-d')
				])->orderBy('updated_at', 'desc');
			}])->orderBy('trophies','desc')->get();

			// Previous members
			$previous = $clan->getSnapshotBefore($current->updated_at->format('Y-m-d H:i:s'));
			$return['csmp'] = ( $previous ? $previous->members()->with(['player', 'ranking' => function($query) use($previous){
				return $query->where([
					['updated_at', '>=', $previous->updated_at->format('Y-m-d')],
					['updated_at', '<', $previous->updated_at->addDay()->format('Y-m-d')]
				])->orderBy('updated_at', 'desc');
			}])->orderBy('trophies','desc')->get()->keyBy('player_id') : null );
		}

		//dd($return);exit;

		return response()->json($return);

		return view('clan', $return);
	}
}
