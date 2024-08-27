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
        // $expected = file_get_contents($this -> pathToResultStylish);
        $result = genDiff($this -> pathToJsonOne, $this -> pathToJsonTwo, 'stylish');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultStylish, $result);
    }

    public function testStylishJsonNested(): void
    {
        // $expected = file_get_contents($this -> pathToResultStylishNested);
        $result = genDiff($this -> pathToJsonThree, $this -> pathToJsonFour, 'stylish');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultStylishNested, $result);
    }

    public function testStylishYaml(): void
    {
        // $expected = file_get_contents($this -> pathToResultStylish);
        $result = genDiff($this -> pathToYamlOne, $this -> pathToYamlTwo, 'stylish');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultStylish, $result);
    }

    public function testStylishYamlNested(): void
    {
        // $expected = file_get_contents($this -> pathToResultStylishNested);
        $result = genDiff($this -> pathToYamlThree, $this -> pathToYamlFour, 'stylish');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultStylishNested, $result);
    }

    public function testStylishYml(): void
    {
        // $expected = file_get_contents($this -> pathToResultStylish);
        $result = genDiff($this -> pathToYmlOne, $this -> pathToYmlTwo, 'stylish');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultStylish, $result);
    }

    public function testStylishYmlNested(): void
    {
        // $expected = file_get_contents($this -> pathToResultStylishNested);
        $result = genDiff($this -> pathToYmlThree, $this -> pathToYmlFour, 'stylish');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultStylishNested, $result);
    }

    public function testPlainJson(): void
    {
        // $expected = file_get_contents($this -> pathToResultPlain);
        $result = genDiff($this -> pathToJsonOne, $this -> pathToJsonTwo, 'plain');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultPlain, $result);
    }

    public function testPlainJsonNested(): void
    {
        // $expected = file_get_contents($this -> pathToResultPlainNested);
        $result = genDiff($this -> pathToJsonThree, $this -> pathToJsonFour, 'plain');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultPlainNested, $result);
    }

    public function testPlainYaml(): void
    {
        // $expected = file_get_contents($this -> pathToResultPlain);
        $result = genDiff($this -> pathToYamlOne, $this -> pathToYamlTwo, 'plain');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultPlain, $result);
    }

    public function testPlainYamlNested(): void
    {
        // $expected = file_get_contents($this -> pathToResultPlainNested);
        $result = genDiff($this -> pathToYamlThree, $this -> pathToYamlFour, 'plain');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultPlainNested, $result);
    }

    public function testPlainYml(): void
    {
        // $expected = file_get_contents($this -> pathToResultPlain);
        $result = genDiff($this -> pathToYmlOne, $this -> pathToYmlTwo, 'plain');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultPlain, $result);
    }

    public function testPlainYmlNested(): void
    {
        // $expected = file_get_contents($this -> pathToResultPlainNested);
        $result = genDiff($this -> pathToYmlThree, $this -> pathToYmlFour, 'plain');
        // $this->assertEquals($expected, $result);
        $this->assertStringEqualsFile($this -> pathToResultPlainNested, $result);
    }
}
