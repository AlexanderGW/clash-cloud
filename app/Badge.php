<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    public $timestamps = false;

    public function clans() {
	    return $this->hasMany('App\Clan');
    }
}
