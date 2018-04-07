<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function titles()
    {
        return $this->hasMany(Title::class)
            ->orderBy("order");
    }
}
