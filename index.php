<?php declare(strict_types=1);

use Kirby\Cms\App;

App::plugin("kenshodigital/kirby-html", [
    "hooks" => [
        "page.render:after" => require __DIR__ . "/hooks/page/render/after.php",
    ],
]);
