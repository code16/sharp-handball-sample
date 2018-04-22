<?php

namespace App\Sharp;

use App\Player;
use Code16\Sharp\EntityList\Commands\InstanceCommand;

class SetPlayerInjuredCommand extends InstanceCommand
{

    /**
     * @return string
     */
    public function label(): string
    {
        return "Declare injured";
    }

    /**
     * @param string $instanceId
     * @param array $data
     * @return array
     */
    public function execute($instanceId, array $data = []): array
    {
        Player::findOrFail($instanceId)->setInjured(true);

        return $this->reload();
    }
}