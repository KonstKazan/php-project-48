<?php

namespace App\Testing;

use Symfony\Component\Yaml\Yaml;

use function App\Parsers\parse;

require_once __DIR__ . '/../vendor/autoload.php';

function makeNode(string $status, string $key, $valueOne, $valueTwo = null)
{
    return ['status' => $status, 'key' => $key, 'valueOne' => $valueOne, 'valueTwo' => $valueTwo];
}

function buildThree($decodeFileOne, $decodeFileTwo)
{
    $fileOneKeys = array_keys($decodeFileOne);
    $fileTwoKeys = array_keys($decodeFileTwo);
    $arrayKeys = array_unique(array_merge($fileOneKeys, $fileTwoKeys));
    $sortArrayKeys = $arrayKeys;
    uasort($sortArrayKeys, function ($valueOne, $valueTwo) {
        return strcmp($valueOne, $valueTwo);
    });
    return array_map(fn ($key) => ast($key, $decodeFileOne, $decodeFileTwo), $sortArrayKeys);
}

function toString($value)
{
    $iter = function ($value) use (&$iter) {
        if (!is_array($value)) {
            if ($value === null) {
                return 'null';
            }
            return trim(var_export($value, true), "'");
        }

        $keys = array_keys($value);
        return array_map(function ($key) use ($value, $iter) {
            $value = (is_array($value[$key])) ? $iter($value[$key]) : $value[$key];

            return makeNode('unchanged', $key, $value);
        }, $keys);
    };

    return $iter($value);
}

function ast($key, $fileOne, $fileTwo)
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

function formatStylish(array $astTree, int $depth = 0): string
{
    $indent = str_repeat('    ', $depth);

    $lines = array_map(function ($node) use ($indent, $depth) {

        ['status' => $status, 'key' => $key, 'valueOne' => $value, 'valueTwo' => $valueTwo] = $node;

        $normalizeValueOne = (is_array($value)) ? formatStylish($value, $depth + 1) : $value;

        switch ($status) {
            case 'nested':
            case 'unchanged':
                return "{$indent}    {$key}: {$normalizeValueOne}";
            case 'added':
                return "{$indent}  + {$key}: {$normalizeValueOne}";
            case 'deleted':
                return "{$indent}  - {$key}: {$normalizeValueOne}";
            case 'changed':
                $normalizeValueTwo = (is_array($valueTwo)) ? formatStylish($valueTwo, $depth + 1) : $valueTwo;
                return "{$indent}  - {$key}: {$normalizeValueOne}\n{$indent}  + {$key}: {$normalizeValueTwo}";
            // default:
            //     throw new \Exception("Unknown node status: {$status}");
        }
    }, $astTree);
    $result = ["{", ...$lines, "{$indent}}"];
    return implode("\n", $result);
}

function someTest(string $pathToFileOne, string $pathToFileTwo)
{
    $decodeFileOne = parse($pathToFileOne);
    $decodeFileTwo = parse($pathToFileTwo);
    $three = buildThree($decodeFileOne, $decodeFileTwo);
    return formatStylish($three);
}

var_dump(someTest('/tests/fixtures/file1.json', '/tests/fixtures/file2.json'));
