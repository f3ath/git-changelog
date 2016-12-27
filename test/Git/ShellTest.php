<?php
namespace F3\Changelog\Git;

use PHPUnit\Framework\TestCase;

function exec($command, &$output, &$code)
{
    return ShellTest::exec($command, $output, $code);
}

class ShellTest extends TestCase
{
    private static $command = null;
    private static $output = [];
    private static $code = 0;

    public static function exec($command, &$output, &$code)
    {
        self::$command = $command;
        $output = self::$output;
        $code = self::$code;
        return (string) reset(self::$output);
    }

    protected function setUp()
    {
        self::$command = null;
        self::$output = [];
        self::$code = 0;
    }

    public function testExecSuccessful()
    {
        self::$output = ['foo', 'bar'];
        $shell = new Shell();
        $this->assertEquals(self::$output, $shell->exec('boo'));
        $this->assertEquals('boo', self::$command);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage boo
     * @expectedExceptionCode 42
     */
    public function testExecFail()
    {
        self::$code = 42;
        $shell = new Shell();
        $shell->exec('boo');
    }
}
