<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function getRealPath(string $pathToFile): mixed
{
    $addedPart = $pathToFile[0] === '/' ? '' : __DIR__ . "/../";
    $fullPath = $addedPart . $pathToFile;

    $realPath = realpath($fullPath);
    return $realPath;
}

function parse(string $pathToFile,): array
{
    $path = getRealPath($pathToFile);
    $file = file_get_contents($path);
    if ($file !== false) {
        if ((pathinfo($pathToFile, PATHINFO_EXTENSION) === 'json')) {
            $decodeFile = json_decode($file, true);
        } else {
            $decodeFile = Yaml::parse($file);
        }
    } else {
        $decodeFile = [];
    }
    return $decodeFile;
}
