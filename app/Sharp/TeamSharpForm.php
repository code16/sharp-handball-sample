<?php

namespace App\Sharp;

use App\Team;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormListField;
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
        )->addField(
            SharpFormTextField::make("country")
                ->setLabel("Country")
        )->addField(
            SharpFormListField::make("titles")
                ->setLabel("Titles")
                ->setAddable()->setAddText("Add a title")
                ->setRemovable()
                ->addItemField(
                    SharpFormTextField::make("competition")
                        ->setLabel("Competition name")
                )->addItemField(
                    SharpFormTextField::make("title")
                        ->setLabel("Title")
                )
        );
    }

    function buildFormLayout()
    {
        $this->addColumn(6, function(FormLayoutColumn $column) {
            $column->withSingleField("name")
                ->withSingleField("country");
        })->addColumn(6, function(FormLayoutColumn $column) {
            $column->withSingleField("titles", function(FormLayoutColumn $item) {
                $item->withFields("competition|7", "title|5");
            });
        });
    }

    function find($id): array
    {
        return $this->transform(Team::with('titles')->findOrFail($id));
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