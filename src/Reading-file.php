<?php

namespace Differ\Reading\File;

function getRealPath(string $pathToFile): string
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
