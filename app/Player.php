<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = [];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function setInjured(bool $injured)
    {
        $this->update([
            "injured" => $injured
        ]);
    }
}