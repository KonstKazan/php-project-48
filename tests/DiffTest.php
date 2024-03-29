<?php

namespace Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DiffTest extends TestCase
{
    private string $pathToJsonOne;
    private string $pathToJsonTwo;
    private string $pathToYamlOne;
    private string $pathToYamlTwo;
    private string $pathToResultStylish;
    private string $pathToResultPlain;

    public function setUp(): void
    {
        $this -> pathToJsonOne = "tests/fixtures/file1.json";
        $this -> pathToJsonTwo = "tests/fixtures/file2.json";
        $this -> pathToYamlOne = "tests/fixtures/file1.yml";
        $this -> pathToYamlTwo = "tests/fixtures/file2.yml";
        $this -> pathToResultStylish = __DIR__ . "/fixtures/resultStylish.txt";
        $this -> pathToResultPlain = __DIR__ . "/fixtures/resultPlain.txt";
    }

    public function testStylishJson(): void
    {
        $expected = file_get_contents($this -> pathToResultStylish);
        $result = genDiff($this -> pathToJsonOne, $this -> pathToJsonTwo, 'stylish');
        $this->assertEquals($expected, $result);
    }

    public function testStylishYaml(): void
    {
        $expected = file_get_contents($this -> pathToResultStylish);
        $result = genDiff($this -> pathToYamlOne, $this -> pathToYamlTwo, 'stylish');
        $this->assertEquals($expected, $result);
    }

    public function testPlainJson(): void
    {
        $expected = file_get_contents($this -> pathToResultPlain);
        $result = genDiff($this -> pathToJsonOne, $this -> pathToJsonTwo, 'plain');
        $this->assertEquals($expected, $result);
    }

    public function testPlainYaml(): void
    {
        $expected = file_get_contents($this -> pathToResultPlain);
        $result = genDiff($this -> pathToYamlOne, $this -> pathToYamlTwo, 'plain');
        $this->assertEquals($expected, $result);
    }
}
