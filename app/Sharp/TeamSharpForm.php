<?php

namespace App\Sharp;

use App\Team;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class TeamSharpForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    function buildFormFields()
    {
        $this->addField(
            SharpFormTextField::make("name")
                ->setLabel("Name")
        );
    }

    function buildFormLayout()
    {
        $this->addColumn(6, function(FormLayoutColumn $column) {
            $column->withSingleField("name");
        });
    }

    function find($id): array
    {
        return $this->transform(Team::findOrFail($id));
    }

    function update($id, array $data)
    {
        $instance = $id ? Team::findOrFail($id) : new Team;

        return tap($instance, function($team) use($data) {
            $this->save($team, $data);
        })->id;
    }

    function delete($id)
    {
        Team::findOrFail($id)->delete();
    }
}