<?php

namespace Differ\Differ;

use function Differ\Formatter\formatThree;
use function Differ\Parsers\parse;
use function Differ\Reading\File\getExtension;
use function Differ\Reading\File\getFile;
use function Differ\Reading\File\getRealPath;
use function Functional\sort;

function genDiff(string $pathToFileOne, string $pathToFileTwo, string $format = 'stylish'): string
{
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

function makeNode(string $status, string $key, string|array $valueOne, string|array $valueTwo = null): array
{
    return ['status' => $status, 'key' => $key, 'valueOne' => $valueOne, 'valueTwo' => $valueTwo];
}

function toString(mixed $value): string|array
{
    if (!is_array($value)) {
        if ($value === null) {
            return 'null';
        }
        return trim(var_export($value, true), "'");
    }

        $keys = array_keys($value);
        return array_map(function ($key) use ($value) {
            $newValue = (is_array($value[$key])) ? toString($value[$key]) : $value[$key];
            return makeNode('unchanged', $key, $newValue);
        }, $keys);
}

function buildThree(array $decodeFileOne, array $decodeFileTwo): array
{
    $fileOneKeys = array_keys($decodeFileOne);
    $fileTwoKeys = array_keys($decodeFileTwo);
    $arrayKeys = array_unique(array_merge($fileOneKeys, $fileTwoKeys));
    $sortArrayKeys = sort($arrayKeys, fn ($left, $right) => strcmp($left, $right));
    return array_map(fn ($key) => createAst($key, $decodeFileOne, $decodeFileTwo), $sortArrayKeys);
}

function createAst(string $key, array $fileOne, array $fileTwo): array
{
    $valueOne = $fileOne[$key] ?? null;
    $valueTwo = $fileTwo[$key] ?? null;
    if (is_array($valueOne) && is_array($valueTwo)) {
        return makeNode('nested', $key, buildThree($valueOne, $valueTwo));
    }

    if (!array_key_exists($key, $fileOne)) {
        return makeNode('added', $key, toString($valueTwo));
    }

    if (!array_key_exists($key, $fileTwo)) {
        return  makeNode('deleted', $key, toString($valueOne));
    }

    if ($valueOne !== $valueTwo) {
        return makeNode('changed', $key, toString($valueOne), toString($valueTwo));
    }

    return makeNode('unchanged', $key, $valueOne);
}
