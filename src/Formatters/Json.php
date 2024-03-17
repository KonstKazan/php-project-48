<?php

namespace Differ\Formatters\Json;

function formatJson(array $astTree): string|false
{
    return json_encode($astTree);
}
