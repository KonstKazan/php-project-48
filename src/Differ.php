<?php

namespace App\Diff;

function gendiff(string $fileOne, string $fileTwo): string
{
    $one = file_get_contents(dirname(__DIR__, 1) . "/" . $fileOne);
    if ($one === false) {
        return 'File not found';
    }
    $decodeFileOne = json_decode($one, true);
    $two = file_get_contents(dirname(__DIR__, 1) . "/" . $fileTwo);
    if ($two === false) {
        return 'File not found';
    }
    $decodeFileTwo = json_decode($two, true);
    $mergeResult = array_merge($decodeFileOne, $decodeFileTwo);
    ksort($mergeResult);
    $result = [];
    foreach ($mergeResult as $key => $value) {
        if (array_key_exists($key, $decodeFileOne) && array_key_exists($key, $decodeFileTwo)) {
            if ($decodeFileOne[$key] === $decodeFileTwo[$key]) {
                $result[] = '  ' . $key . ': ' . $value;
            } else {
                $result[] = '- ' . $key . ': ' . var_export($decodeFileOne[$key], true);
                $result[] = '+ ' . $key . ': ' . var_export($decodeFileTwo[$key], true);
            }
        } elseif (array_key_exists($key, $decodeFileOne)) {
            $result[] = '- ' . $key . ': ' . var_export($decodeFileOne[$key], true);
        } elseif (array_key_exists($key, $decodeFileTwo)) {
            $result[] = '+ ' . $key . ': ' . var_export($decodeFileTwo[$key], true);
        }
    }
    $resultEnd = implode(PHP_EOL, $result) . PHP_EOL;
    return $resultEnd;
}
