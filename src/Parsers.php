<?php

namespace App\Parsers;

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

use function App\Diff\gendiff;

function parser(string $pathToFileOne, string $pathToFileTwo): string
{
    $fileOne = file_get_contents(dirname(__DIR__, 1) . "/" . $pathToFileOne);
    if ($fileOne === false) {
        return 'File not found';
    }
    $fileTwo = file_get_contents(dirname(__DIR__, 1) . "/" . $pathToFileTwo);
    if ($fileTwo === false) {
        return 'File not found';
    }

    if ((pathinfo($pathToFileOne, PATHINFO_EXTENSION) === 'json') && ((pathinfo($pathToFileTwo, PATHINFO_EXTENSION) === 'json'))) {
        $decodeFileOne = json_decode($fileOne, true);
        $decodeFileTwo = json_decode($fileTwo, true);
    } else {
        $decodeFileOne = Yaml::parse($fileOne);
        $decodeFileTwo = Yaml::parse($fileTwo);
    }
    return gendiff($decodeFileOne, $decodeFileTwo);
}
