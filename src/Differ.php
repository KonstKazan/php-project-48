<?php

namespace Differ\Differ;

use function Differ\Formatter\formatThree;
use function Differ\Parsers\parse;
use function Differ\Utilits\buildThree;
use function Differ\Utilits\getExtension;
use function Differ\Utilits\getFile;
use function Differ\Utilits\getRealPath;

function genDiff(string $pathToFileOne, string $pathToFileTwo, string $format = 'stylish'): string
{
    try {
        getRealPath($pathToFileOne);
        getRealPath($pathToFileTwo);
    } catch (\Exception $e) {
        echo $e->getMessage(), "\n";
    }
    $pathOne = getRealPath($pathToFileOne);
    $pathTwo = getRealPath($pathToFileTwo);
    $fileOne = getFile($pathOne);
    $fileTwo = getFile($pathTwo);
    $extensionOne = getExtension($pathToFileOne);
    $extensionTwo = getExtension($pathToFileTwo);
    $decodeFileOne = parse($extensionOne, $fileOne);
    $decodeFileTwo = parse($extensionTwo, $fileTwo);
    $three = buildThree($decodeFileOne, $decodeFileTwo);
    return formatThree($three, $format);
}
