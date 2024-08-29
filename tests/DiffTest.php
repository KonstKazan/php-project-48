<?php

namespace Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DiffTest extends TestCase
{
    private string $pathToJsonOne;
    private string $pathToJsonTwo;
    private string $pathToJsonThree;
    private string $pathToJsonFour;
    private string $pathToYamlOne;
    private string $pathToYamlTwo;
    private string $pathToYamlThree;
    private string $pathToYamlFour;
    private string $pathToYmlOne;
    private string $pathToYmlTwo;
    private string $pathToYmlThree;
    private string $pathToYmlFour;
    private string $pathToResultStylish;
    private string $pathToResultStylishNested;
    private string $pathToResultPlain;
    private string $pathToResultPlainNested;

    public function setUp(): void
    {
        $this -> pathToJsonOne = "tests/fixtures/file1.json";
        $this -> pathToJsonTwo = "tests/fixtures/file2.json";
        $this -> pathToJsonThree = "tests/fixtures/file3.json";
        $this -> pathToJsonFour = "tests/fixtures/file4.json";
        $this -> pathToYamlOne = "tests/fixtures/file1.yaml";
        $this -> pathToYamlTwo = "tests/fixtures/file2.yaml";
        $this -> pathToYamlThree = "tests/fixtures/file3.yaml";
        $this -> pathToYamlFour = "tests/fixtures/file4.yaml";
        $this -> pathToYmlOne = "tests/fixtures/file1.yml";
        $this -> pathToYmlTwo = "tests/fixtures/file2.yml";
        $this -> pathToYmlThree = "tests/fixtures/file3.yml";
        $this -> pathToYmlFour = "tests/fixtures/file4.yml";
        $this -> pathToResultStylish = __DIR__ . "/fixtures/resultStylish.txt";
        $this -> pathToResultStylishNested = __DIR__ . "/fixtures/resultStylishNested.txt";
        $this -> pathToResultPlain = __DIR__ . "/fixtures/resultPlain.txt";
        $this -> pathToResultPlainNested = __DIR__ . "/fixtures/resultPlainNested.txt";
    }

    public function testStylishJson(): void
    {
        $result = genDiff($this -> pathToJsonOne, $this -> pathToJsonTwo, 'stylish');
        $this->assertStringEqualsFile($this -> pathToResultStylish, $result);
    }

    public function testStylishJsonNested(): void
    {
        $result = genDiff($this -> pathToJsonThree, $this -> pathToJsonFour, 'stylish');
        $this->assertStringEqualsFile($this -> pathToResultStylishNested, $result);
    }

    public function testStylishYaml(): void
    {
        $result = genDiff($this -> pathToYamlOne, $this -> pathToYamlTwo, 'stylish');
        $this->assertStringEqualsFile($this -> pathToResultStylish, $result);
    }

    public function testStylishYamlNested(): void
    {
        $result = genDiff($this -> pathToYamlThree, $this -> pathToYamlFour, 'stylish');
        $this->assertStringEqualsFile($this -> pathToResultStylishNested, $result);
    }

    public function testStylishYml(): void
    {
        $result = genDiff($this -> pathToYmlOne, $this -> pathToYmlTwo, 'stylish');
        $this->assertStringEqualsFile($this -> pathToResultStylish, $result);
    }

    public function testStylishYmlNested(): void
    {
        $result = genDiff($this -> pathToYmlThree, $this -> pathToYmlFour, 'stylish');
        $this->assertStringEqualsFile($this -> pathToResultStylishNested, $result);
    }

    public function testPlainJson(): void
    {
        $result = genDiff($this -> pathToJsonOne, $this -> pathToJsonTwo, 'plain');
        $this->assertStringEqualsFile($this -> pathToResultPlain, $result);
    }

    public function testPlainJsonNested(): void
    {
        $result = genDiff($this -> pathToJsonThree, $this -> pathToJsonFour, 'plain');
        $this->assertStringEqualsFile($this -> pathToResultPlainNested, $result);
    }

    public function testPlainYaml(): void
    {
        $result = genDiff($this -> pathToYamlOne, $this -> pathToYamlTwo, 'plain');
        $this->assertStringEqualsFile($this -> pathToResultPlain, $result);
    }

    public function testPlainYamlNested(): void
    {
        $result = genDiff($this -> pathToYamlThree, $this -> pathToYamlFour, 'plain');
        $this->assertStringEqualsFile($this -> pathToResultPlainNested, $result);
    }

    public function testPlainYml(): void
    {
        $result = genDiff($this -> pathToYmlOne, $this -> pathToYmlTwo, 'plain');
        $this->assertStringEqualsFile($this -> pathToResultPlain, $result);
    }

    public function testPlainYmlNested(): void
    {
        $result = genDiff($this -> pathToYmlThree, $this -> pathToYmlFour, 'plain');
        $this->assertStringEqualsFile($this -> pathToResultPlainNested, $result);
    }
}
