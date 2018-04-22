<?php

namespace App\Sharp;

use App\Player;
use Code16\Sharp\EntityList\Commands\InstanceCommand;

class SetPlayerRecoveredCommand extends InstanceCommand
{

    /**
     * @return string
     */
    public function label(): string
    {
        return "Declare recovered";
    }

    /**
     * @param string $instanceId
     * @param array $data
     * @return array
     */
    public function execute($instanceId, array $data = []): array
    {
        Player::findOrFail($instanceId)->setInjured(false);

        return $this->reload();
    }

    /**
     * @param $instanceId
     * @return bool
     */
    public function authorizeFor($instanceId): bool
    {
        return Player::findOrFail($instanceId)->injured;
    }
}