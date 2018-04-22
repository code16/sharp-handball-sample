<?php

namespace App\Sharp;

use App\Player;
use Code16\Sharp\EntityList\Commands\InstanceCommand;
use Code16\Sharp\Form\Fields\SharpFormTextareaField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;

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
     * @throws \Illuminate\Validation\ValidationException
     */
    public function execute($instanceId, array $data = []): array
    {
        $this->validate($data, [
            "detail" => "required"
        ]);

        Player::findOrFail($instanceId)->setInjured(true);

        return $this->reload();
    }

    /**
     * @param $instanceId
     * @return bool
     */
    public function authorizeFor($instanceId): bool
    {
        return !Player::findOrFail($instanceId)->injured;
    }

    public function buildFormFields()
    {
        return $this->addField(
            SharpFormTextareaField::make("detail")
                ->setLabel("Detail")
        );
    }

    public function buildFormLayout(FormLayoutColumn &$column)
    {
        $column->withSingleField("detail");
    }
}