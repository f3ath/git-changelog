<?php
namespace F3\Changelog;

use PHPUnit\Framework\TestCase;

class VersionsTest extends TestCase
{
    public function testVersionsFilteringAndSorting()
    {
        $tags = [
            '0.0.1',
            'foobar',
            '1.0.0-alpha',
            '1.0.0',
            '1.0.0-RC'
        ];

        $version = Versions::fromTags($tags);
        $this->assertEquals('0.0.1', $version->getFirst());
        $this->assertEquals('1.0.0', $version->getLast());
        $this->assertEquals('1.0.0-RC', $version->getPreceding('1.0.0'));
        $this->assertEquals('1.0.0-alpha', $version->getPreceding('1.0.0-RC'));
        $this->assertEquals('0.0.1', $version->getPreceding('1.0.0-alpha'));
    }

    /**
     * @expectedException \OutOfRangeException
     * @expectedExceptionMessage  No preceding version exists
     */
    public function testNoPrecedingVersion()
    {
        $versions = Versions::fromTags(['1']);
        $versions->getPreceding('1');
    }

    /**
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Version 3 not found
     */
    public function testVersionNotFound()
    {
        $versions = Versions::fromTags(['1']);
        $versions->getPreceding('3');
    }

    public function invalidTagSets(): array
    {
        return [
            [[]],
            [['foo']]
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage No versions found
     * @dataProvider invalidTagSets
     */
    public function testEmptySet(array $tags)
    {
        Versions::fromTags($tags);
    }
}