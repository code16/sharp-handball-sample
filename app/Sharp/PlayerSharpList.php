<?php

namespace App\Sharp;

use App\Player;
use Code16\Sharp\EntityList\Containers\EntityListDataContainer;
use Code16\Sharp\EntityList\EntityListQueryParams;
use Code16\Sharp\EntityList\SharpEntityList;

class PlayerSharpList extends SharpEntityList
{

    function buildListDataContainers()
    {
        $this->addDataContainer(
            EntityListDataContainer::make("name")
                ->setLabel("Name")
                ->setSortable()
        )->addDataContainer(
            EntityListDataContainer::make("team:name")
                ->setLabel("Team")
                ->setSortable()
        )->addDataContainer(
            EntityListDataContainer::make("ratings")
                ->setLabel("Ratings")
                ->setSortable()
        );
    }

    function buildListConfig()
    {
        $this->setPaginated()
            ->setSearchable()
            ->addFilter("team", TeamFilter::class)
            ->addEntityCommand("set_injured", SetPlayerInjuredCommand::class)
            ->addEntityCommand("set_recovered", SetPlayerRecoveredCommand::class);
    }

    function buildListLayout()
    {
        $this->addColumn("name", 4)
            ->addColumn("team:name", 4)
            ->addColumn("ratings", 4);
    }

    function getListData(EntityListQueryParams $params)
    {
        $players = Player::orderBy(
            $params->sortedBy(), $params->sortedDir()
        )->where("team_id", $params->filterFor("team"));

        collect($params->searchWords())
            ->each(function($word) use($players) {
                $players->where(function ($query) use ($word) {
                    $query->orWhere('name', 'like', $word)
                        ->orWhere('team', 'like', $word);
                });
            });

        return $this
            ->setCustomTransformer("name", function($name, $player) {
                return $player->name .
                    ($player->injured ? " (<em>injured</em>)" : "");
            })
            ->setCustomTransformer("ratings", function($rating) {
                return collect(array_fill(0, $rating, ""))
                    ->map(function() {
                        return '<span class="fa fa-star"></span>';
                    })
                    ->implode('');
            })
            ->transform(
                $players->with("team")->paginate(30)
            );
    }
}