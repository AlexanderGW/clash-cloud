<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function user() {
	    return $this->belongsTo('App\User');
    }

	public function getAvatarUrl() {
		return asset('storage/avatars/' . $this->avatar);
	}

	public function getCountry() {
		return $this->country;
	}

	public function getCountryName() {
		return 'United Kingdom';
	}
}