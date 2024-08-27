<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $extension, string $file): array
{
    // $path = getRealPath($pathToFile);
    // $file = getFile($path);
    // $extension = getExtension($pathToFile);

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
