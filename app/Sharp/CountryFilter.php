<?php

namespace App\Sharp;

use App\Team;
use Code16\Sharp\EntityList\EntityListFilter;

class CountryFilter implements EntityListFilter
{

    /**
     * @return array
     */
    public function values()
    {
        return Team::select("country")
            ->orderBy("country")
            ->pluck("country", "country");
    }
}