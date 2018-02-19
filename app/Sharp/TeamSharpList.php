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
            EntityListDataContainer::make("players")
                ->setLabel("Players")
        );
    }

    function buildListConfig()
    {
        $this->setPaginated();
    }

    function buildListLayout()
    {
        $this->addColumn("name", 8)
            ->addColumn("players", 4);
    }

    function getListData(EntityListQueryParams $params)
    {
        return $this
            ->setCustomTransformer("players", function($players, $team) {
                return $team->players()->count();
            })
            ->transform(
                Team::orderBy("name", "asc")->paginate(30)
            );
    }
}