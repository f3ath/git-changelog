<?php
namespace F3\Changelog\Cli;

use PHPUnit\Framework\TestCase;

class ArgvInputTest extends TestCase
{
    public function testGetTag()
    {
        $this->assertEquals('0.1.2', (new ArgvInput([null, '0.1.2']))->getTag());
        $this->assertNull((new ArgvInput([null]))->getTag());
    }
}
