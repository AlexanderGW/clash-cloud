<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'country' => 'required|max:2',
			'password' => 'required|min:6|password'
		]);

		$profile = \App\Profile::find(['user_id' => Auth::user()->id])->first();
		if($request->hasFile('avatar')) {
			if($request->file('avatar')->isValid()) {
				$path = $request->file('avatar')->store('public/avatars');
				if($path) {
					$profile->avatar = pathinfo( $path, PATHINFO_BASENAME );
					//TODO: GD Resampling
				}
			}
		}
		$profile->country = $request['country'];
		$profile->update();

		return redirect()->route('dashboard')->with(['status' => 'Profile successfully updated.']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('profile', ['user' => Auth::user()]);
	}
}
