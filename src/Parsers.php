<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function getRealPath(string $pathToFile): mixed
{
    $addedPart = $pathToFile[0] === '/' ? '' : __DIR__ . "/../";
    $fullPath = $addedPart . $pathToFile;
    $realPath = realpath($fullPath);
    if ($realPath === false) {
        throw new \Exception("File not exists");
    }
    return $realPath;
}

function getExtension(string $pathToFile): string
{
    return pathinfo($pathToFile, PATHINFO_EXTENSION);
}

function getFile(string $path): string
{
    $file = file_get_contents($path);
    if ($file === false) {
        throw new \Exception("Path to file is invalid!");
    }
    return $file;
}

function parse(string $pathToFile,): array
{
    $path = getRealPath($pathToFile);
    $file = getFile($path);
    $extension = getExtension($pathToFile);

    switch ($extension) {
        case 'json':
            return json_decode($file, true);
        case 'yaml':
        case 'yml':
            return Yaml::parse($file);
        default:
            throw new \Exception("$extension is invalid format!");
    }
}
