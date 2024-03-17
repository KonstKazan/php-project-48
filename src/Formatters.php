<?php

namespace Differ\Formatter;

use function Differ\Formatters\Json\formatJson;
use function Differ\Formatters\Plain\formatPlain;
use function Differ\Formatters\Stylish\formatStylish;

function formatThree(array $three, string $format): string|false
{
    if ($format === 'stylish') {
        return formatStylish($three);
    } elseif ($format === 'plain') {
        return formatPlain(($three));
    } elseif ($format === 'json') {
        return formatJson($three);
    } else {
        return 'Unknow format';
    }
}
