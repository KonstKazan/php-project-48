<?php

namespace Differ\Formatter;

use function Differ\Formatters\Json\formatJson;
use function Differ\Formatters\Plain\formatPlain;
use function Differ\Formatters\Stylish\formatStylish;

function formatThree(array $three, string $format): string
{
    switch ($format) {
        case 'stylish':
            return formatStylish($three);
        case 'plain':
            return formatPlain(($three));
        case 'json':
            return formatJson($three);
        default:
            throw new \Exception("$format is unknow format!");
    }
}
