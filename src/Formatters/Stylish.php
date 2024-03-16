<?php

namespace App\Formatters\Stylish;

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
