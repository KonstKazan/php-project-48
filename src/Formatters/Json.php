<?php

namespace App\Formatters\Json;

function formatJson(array $astTree)
{
    return json_encode($astTree);
}