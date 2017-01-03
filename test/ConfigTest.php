<?php
namespace F3\Changelog;

use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfigCanBeOverridden()
    {
        $this->assertEquals(
            [
                'remote'       => 'upstream',
                'git'          => 'MyGit',
                'repo_factory' => 'MyRepoFactory',

            ],
            Config::fromJsonFile(__DIR__ . '/configs/valid-config.json')
        );
    }

    public function testMissingJsonFileProducesDefaultValues()
    {
        $this->assertEquals(
            [
                'remote'       => 'origin',
                'git'          => 'F3\Changelog\Git\Git',
                'repo_factory' => 'F3\Changelog\RepositoryFactory',

            ],
            Config::fromJsonFile(__DIR__ . '/configs/i-do-not-exist.json')
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
