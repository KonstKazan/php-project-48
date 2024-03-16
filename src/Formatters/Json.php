<?php

namespace App\Formatters\Json;

function formatJson(array $astTree): string|false
{
    return json_encode($astTree);
}
