<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $pathToFile,): array
{
    $file = file_get_contents(dirname(__DIR__) . $pathToFile);
    if ($file === false) {
        exit('File not found');
    }

    if ((pathinfo($pathToFile, PATHINFO_EXTENSION) === 'json')) {
        $decodeFile = json_decode($file, true);
    } else {
        $decodeFile = Yaml::parse($file);
    }
    return $decodeFile;
}
