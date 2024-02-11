<?php

function gendiff(string $fileOne, string $fileTwo)
{
    $one = file_get_contents(__DIR__ . "/.." . $fileOne);
    $decodeFileOne = json_decode($one, true);
    $two = file_get_contents(__DIR__ . "/.." . $fileTwo);
    $decodeFileTwo = json_decode($two, true);
    $mergeResult = array_merge($decodeFileOne, $decodeFileTwo);
    ksort($mergeResult);
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
    print_r($resultEnd);
}
