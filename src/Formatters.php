<?php

namespace App\Formatter;

use function App\Formatters\Json\formatJson;
use function App\Formatters\Plain\formatPlain;
use function App\Formatters\Stylish\formatStylish;

function formatThree($three, $format)
{
    if ($format === 'stylish') {
        return formatStylish($three);
    } elseif ($format === 'plain') {
        return formatPlain(($three));
    } elseif ($format === 'json') {
        // return formatJson($three);
        return $three;
    }
}
