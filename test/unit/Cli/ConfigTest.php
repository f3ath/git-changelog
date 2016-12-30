<?php
namespace F3\Changelog\Cli;

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testNewInstance()
    {
        $this->assertEquals('origin', (new Config())['remote']);
    }

    public function testCanOverrideRemote()
    {
        $this->assertEquals('upstream', Config::fromJsonFile(__DIR__ . '/valid-config.json')['remote']);
        $this->assertEquals('upstream', Config::fromJsonFileIgnoreMissing(__DIR__ . '/valid-config.json')['remote']);
    }

    /**
     * @expectedException \F3\Changelog\Exception\InvalidConfigFile
     */
    public function testInvalidJsonFileThrowsException()
    {
        Config::fromJsonFile(__DIR__ . '/invalid-config.json');
    }

    /**
     * @expectedException \F3\Changelog\Exception\FileNotFound
     */
    public function testMissingJsonFileThrowsException()
    {
        Config::fromJsonFile('i-do-not-exist.json');
    }

    public function testMissingJsonFileReturnsDefaultConfig()
    {
        $this->assertEquals('origin', Config::fromJsonFileIgnoreMissing(__DIR__ . '/i-do-not-exist.json')['remote']);
    }
}
