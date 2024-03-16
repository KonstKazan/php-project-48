<?php

namespace App\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $pathToFile,): array
{
    $file = file_get_contents(dirname(__DIR__, 1) . "/" . $pathToFile);
    if ($file === false) {
        return 'File not found';
    }

    if ((pathinfo($pathToFile, PATHINFO_EXTENSION) === 'json')) {
        $decodeFile = json_decode($file, true);
    } else {
        $decodeFile = Yaml::parse($file);
    }
    return $decodeFile;
}
