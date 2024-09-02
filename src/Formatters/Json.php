<?php

namespace Differ\Formatters\Json;

function formatJson(array $astTree): string
{
    if ((bool) json_encode($astTree)) {
        return json_encode($astTree);
    }
    throw new \Exception("Unknow error!");
}
