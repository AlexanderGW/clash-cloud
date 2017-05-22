<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WarFrequency extends Model
{
    public function clans() {
	    return $this->hasMany('App\Clan');
    }
}
