<?php
namespace F3\Changelog;

use F3\Changelog\RevisionRange\RevisionsBetween;
use F3\Changelog\RevisionRange\RevisionsTo;
use PHPUnit\Framework\TestCase;

class RevisionRangeTest extends TestCase
{
    public function testRevisionsTo()
    {
        $range = new RevisionsTo('foo');
        $this->assertEquals('foo', $range->getRevSpec());
    }

    public function testRevisionsBetween()
    {
        $range = new RevisionsBetween('foo', 'bar');
        $this->assertEquals('foo..bar', $range->getRevSpec());
    }
}