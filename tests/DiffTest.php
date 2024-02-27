<?php

namespace App\Diff\Tests;

use PHPUnit\Framework\TestCase;

use function App\Diff\gendiff;

class DiffTest extends TestCase
{
    public function testIsString(): void
    {
        $this->assertIsString(gendiff("tests/fixtures/file1.json", "tests/fixtures/file2.json"));
    }
}
