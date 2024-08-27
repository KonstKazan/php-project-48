<?php

namespace Differ\Utilits;

use function Functional\sort;

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
    $valueOne = isset($fileOne[$key]) ? $fileOne[$key] : null;
    $valueTwo = isset($fileTwo[$key]) ? $fileTwo[$key] : null;
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
