<?php

namespace App\Sharp;

use App\Player;
use App\Team;
use Code16\Sharp\Form\Eloquent\Transformers\FormUploadModelTransformer;
use Code16\Sharp\Form\Eloquent\WithSharpFormEloquentUpdater;
use Code16\Sharp\Form\Fields\SharpFormAutocompleteField;
use Code16\Sharp\Form\Fields\SharpFormSelectField;
use Code16\Sharp\Form\Fields\SharpFormTextField;
use Code16\Sharp\Form\Fields\SharpFormUploadField;
use Code16\Sharp\Form\Layout\FormLayoutColumn;
use Code16\Sharp\Form\SharpForm;

class PlayerSharpForm extends SharpForm
{
    use WithSharpFormEloquentUpdater;

    function buildFormFields()
    {
        $this->addField(
            SharpFormTextField::make("name")
                ->setLabel("Name")
        )->addField(
            SharpFormAutocompleteField::make("team_id", "local")
                ->setLabel("Team")
                ->setLocalSearchKeys(["name"])
                ->setLocalValues(Team::all())
                ->setListItemInlineTemplate("{{name}}")
                ->setResultItemInlineTemplate("{{name}}")
        )->addField(
            SharpFormSelectField::make(
                "ratings",
                array_combine(range(1, 5), range(1, 5))
            )
                ->setLabel("Ratings")
                ->setDisplayAsDropdown()
        )->addField(
            SharpFormUploadField::make("picture")
                ->setLabel("Picture")
                ->setFileFilterImages()
                ->setCropRatio("1:1")
                ->setStorageDisk("local")
                ->setStorageBasePath("data/Players/{id}")
        )->addField(
            SharpFormTextField::make("picture:copyright")
                ->setLabel("Copyright")
        );
    }

    function buildFormLayout()
    {
        $this->addColumn(6, function(FormLayoutColumn $column) {
            $column->withSingleField("name")
                ->withFields("team_id|6", "ratings|6");
        })->addColumn(6, function(FormLayoutColumn $column) {
            $column->withSingleField("picture")
                ->withSingleField("picture:copyright");
        });
    }

    function find($id): array
    {
        return $this->setCustomTransformer(
            "picture",
            new FormUploadModelTransformer()
        )->transform(
            Player::with("picture")->findOrFail($id)
        );
    }

    function update($id, array $data)
    {
        $instance = $id ? Player::findOrFail($id) : new Player;

        return tap($instance, function($player) use($data) {
            $this->save($player, $data);
        })->id;
    }

    function delete($id)
    {
        Player::findOrFail($id)->delete();
    }
}