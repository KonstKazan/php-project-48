<?php

namespace Differ\Formatters\Plain;

function convertValue(mixed $value): mixed
{
    if (!is_array($value)) {
        if ($value === 'null') {
            return $value;
        }
        if ($value === 'true' || $value === 'false') {
            return $value;
        }
        if (is_numeric($value)) {
            return $value;
        }
        return "'{$value}'";
    }
    return "[complex value]";
}

function formatPlain(array $astTree, string $propertyName = ''): string
{
    $result = array_map(function ($node) use ($propertyName) {

        ['status' => $status, 'key' => $key, 'valueOne' => $value, 'valueTwo' => $valueTwo] = $node;
        $newPropertyName = $propertyName === '' ? $key : "{$propertyName}.{$key}";
        if ($status === 'nested') {
            return formatPlain($value, $newPropertyName);
        } elseif ($status === 'added') {
            $convertValue = convertValue($value);
            return 'Property ' . "'$newPropertyName'" . ' was added with value: ' . $convertValue;
        } elseif ($status === 'deleted') {
            return 'Property ' . "'$newPropertyName'" . ' was removed';
        } elseif ($status === 'changed') {
            $convertValue = convertValue($value);
            $convertValueTwo = convertValue($valueTwo);
            return 'Property ' . "'$newPropertyName'" . ' was updated. From ' .
            $convertValue . ' to ' . $convertValueTwo;
        } elseif ($status === 'unchanged') {
            return;
        }
    }, $astTree);
    $filteredResult = array_diff($result, array(''));
    return implode(PHP_EOL, $filteredResult);
}
