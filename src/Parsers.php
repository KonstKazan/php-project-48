<?php

namespace Differ\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse(string $extension, string $file): array
{
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
