<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function memberships() {
        return $this->hasMany(ClanMember::class);
    }

    public function rankings() {
        return $this->hasMany(LocationSnapshotPlayer::class);
    }
}