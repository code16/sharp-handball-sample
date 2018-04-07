<?php

return [

    "name" => "Handball sample",

    "entities" => [
        "players" => [
            "list" => \App\Sharp\PlayerSharpList::class,
            "form" => \App\Sharp\PlayerSharpForm::class,
            "validator" => \App\Sharp\PlayerSharpValidator::class,
        ],
        "teams" => [
            "list" => \App\Sharp\TeamSharpList::class,
            "form" => \App\Sharp\TeamSharpForm::class,
            "validator" => \App\Sharp\TeamSharpValidator::class,
        ],
    ],

    "menu" => [
        [
            "label" => "Championship",
            "entities" => [
                "players" => [
                    "label" => "Players",
                    "icon" => "fa-user-o"
                ],
                "teams" => [
                    "label" => "Teams",
                    "icon" => "fa-users"
                ],
            ]
        ],
    ],

    "uploads" => [
        "tmp_dir" => env("SHARP_UPLOADS_TMP_DIR", "tmp"),
        "thumbnails_dir" => env("SHARP_UPLOADS_THUMBS_DIR", "thumbnails"),
    ],

    "auth" => [
        "login_attribute" => "email",
        "password_attribute" => "password",
        "display_attribute" => "name",
    ]
];