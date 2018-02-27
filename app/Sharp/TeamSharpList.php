<?php

namespace App\Sharp;

use App\Team;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class TeamSharpList extends SharpEntityList
{

    function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make("name")
                ->setLabel("Name")
        )->addDataContainer(
            EntityListDataContainer::make("country")
                ->setLabel("Country")
        )->addDataContainer(
            EntityListDataContainer::make("players")
                ->setLabel("Players")
        );
    }

    function buildListConfig()
    {
        $this->setPaginated()
            ->addFilter("country", CountryFilter::class);
    }

    function buildListLayout()
    {
        $this->addColumn("name", 4)
            ->addColumn("country", 4)
            ->addColumn("players", 4);
    }

    function getListData(EntityListQueryParams $params)
    {
        $teams = Team::orderBy("name", "asc");

        if($country = $params->filterFor("country")) {
            $teams->where("country", $country);
        }

        return $this
            ->setCustomTransformer("players", function($players, $team) {
                return $team->players()->count();
            })
            ->transform(
                $teams->paginate(30)
            );
    }
}