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

    public function picture()
    {
        return $this->morphOne(Media::class, "model")
            ->where("model_key", "picture");
    }

    public function setInjured(bool $injured)
    {
        $this->update([
            "injured" => $injured
        ]);
    }

    public function getDefaultAttributesFor($attribute)
    {
        return $attribute == "picture"
            ? ["model_key" => $attribute]
            : [];
    }
}