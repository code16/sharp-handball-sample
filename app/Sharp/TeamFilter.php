<?php

namespace App\Sharp;

use App\Team;
use Code16\Sharp\EntityList\EntityListRequiredFilter;

class TeamFilter implements EntityListRequiredFilter
{

    /**
     * @return array
     */
    public function values()
    {
        return Team::orderBy("name")
            ->pluck("name", "id");
    }

    /**
     * @return string|int
     */
    public function defaultValue()
    {
        return Team::first()->id;
    }
}