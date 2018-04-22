<?php

namespace App\Sharp;

use App\Player;
use Code16\Sharp\EntityList\Commands\EntityCommand;
use Code16\Sharp\EntityList\EntityListQueryParams;

class SetAllTeamInjuredCommand extends EntityCommand
{

    /**
     * @return string
     */
    public function label(): string
    {
        return "Declare all team injured";
    }

    /**
     * @param EntityListQueryParams $params
     * @param array $data
     * @return array
     */
    public function execute(EntityListQueryParams $params, array $data = []): array
    {
        Player::where("team_id", $params->filterFor("team"))
            ->get()
            ->each(function(Player $player) {
                $player->setInjured(true);
            });

        return $this->reload();
    }

    /**
     * @return null|string
     */
    public function confirmationText()
    {
        return "Are you like really sure?";
    }
}