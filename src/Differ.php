<?php

namespace App\Diff;

use function App\Formatter\formatThree;
use function App\Parsers\parse;
use function App\Utilits\buildThree;

function gendiff(string $pathToFileOne, string $pathToFileTwo, string $format = 'stylish'): string|false
{
    $decodeFileOne = parse($pathToFileOne);
    $decodeFileTwo = parse($pathToFileTwo);
    $three = buildThree($decodeFileOne, $decodeFileTwo);
    return formatThree($three, $format);
}
