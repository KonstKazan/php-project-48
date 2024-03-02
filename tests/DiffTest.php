<?php

namespace App\Diff\Tests;

use PHPUnit\Framework\TestCase;

use function App\Diff\gendiff;
use function App\Parsers\parser;

class DiffTest extends TestCase
{
    public function testIsString(): void
    {
        $this->assertIsString(parser("tests/fixtures/file1.json", "tests/fixtures/file2.json"));
    }
}
