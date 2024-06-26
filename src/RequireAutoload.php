<?php

namespace Differ\RequireAutoload;

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';

if (file_exists($autoloadPath1)) {
    return require_once $autoloadPath1;
} else {
    return require_once $autoloadPath2;
}
