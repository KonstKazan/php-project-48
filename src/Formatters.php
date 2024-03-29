<?php

namespace Differ\Formatter;

use function Differ\Formatters\Json\formatJson;
use function Differ\Formatters\Plain\formatPlain;
use function Differ\Formatters\Stylish\formatStylish;

function formatThree(array $three, string $format): string|false
{
    switch ($format) {
        case 'stylish':
            return formatStylish($three);
            break;
        case 'plain':
            return formatPlain(($three));
            break;
        case 'json':
            return formatJson($three);
            break;
        default:
            throw new \Exception("$format is unknow format!");
    }
}
