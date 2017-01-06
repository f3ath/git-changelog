<?php
namespace F3\Changelog;

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfigCanBeOverridden()
    {
        $this->assertEquals(
            'upstream',
            Config::fromJsonFile(__DIR__ . '/configs/valid-config.json')->getRemoteName()
        );
    }

    public function testMissingJsonFileProducesDefaultValues()
    {
        $this->assertEquals(
            'origin',
            Config::fromJsonFile(__DIR__ . '/configs/i-do-not-exist.json')->getRemoteName()
        );
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage JSON config file must contain a valid JSON object
     */
    public function testInvalidJsonThrowsException()
    {
        Config::fromJsonFile(__DIR__ . '/configs/invalid-config.json');
    }
}
