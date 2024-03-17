<?php

namespace Differ\Differ;

use function Differ\Formatter\formatThree;
use function Differ\Parsers\parse;
use function Differ\Utilits\buildThree;

function genDiff(string $pathToFileOne, string $pathToFileTwo, string $format = 'stylish'): string|false
{
    $decodeFileOne = parse($pathToFileOne);
    $decodeFileTwo = parse($pathToFileTwo);
    $three = buildThree($decodeFileOne, $decodeFileTwo);
    return formatThree($three, $format);
}
