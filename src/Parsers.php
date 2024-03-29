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
    $extension = pathinfo($pathToFile, PATHINFO_EXTENSION);
    if ($file === false) {
        throw new \Exception("Path to file is invalid!");
    }
    switch ($extension) {
        case 'json':
            return json_decode($file, true);
            break;
        case 'yaml':
        case 'yml':
            return Yaml::parse($file);
        default:
            throw new \Exception("$extension is invalid format!");
    }
}
