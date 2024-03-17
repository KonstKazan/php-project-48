<?php

namespace Differ\Utilits;

function makeNode(string $status, string $key, mixed $valueOne, mixed $valueTwo = null): array
{
    return ['status' => $status, 'key' => $key, 'valueOne' => $valueOne, 'valueTwo' => $valueTwo];
}

// function toString(mixed $value): mixed
// {
//     $iter = function ($value) use (&$iter) {
//         if (!is_array($value)) {
//             if ($value === null) {
//                 return 'null';
//             }
//             return trim(var_export($value, true), "'");
//         }

//         $keys = array_keys($value);
//         return array_map(function ($key) use ($value, $iter) {
//             $value = (is_array($value[$key])) ? $iter($value[$key]) : $value[$key];

//             return makeNode('unchanged', $key, $value);
//         }, $keys);
//     };

//     return $iter($value);
// }

function toString(mixed $value): mixed
{
    // $iter = function ($value) use (&$iter) {
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
    // };

    // return $iter($value);
}

function buildThree(array $decodeFileOne, array $decodeFileTwo): array
{
    $fileOneKeys = array_keys($decodeFileOne);
    $fileTwoKeys = array_keys($decodeFileTwo);
    $arrayKeys = array_unique(array_merge($fileOneKeys, $fileTwoKeys));
    $sortArrayKeys = $arrayKeys;
    uasort($sortArrayKeys, function ($valueOne, $valueTwo) {
        return strcmp($valueOne, $valueTwo);
    });
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
