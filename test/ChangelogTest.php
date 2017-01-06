<?php
namespace F3\Changelog;

use F3\Changelog\Git\Commit;
use PHPUnit\Framework\TestCase;

class ChangelogTest extends TestCase
{
    private $git;

    /**
     * @var Changelog
     */
    private $changelog;

    protected function setUp()
    {
        $this->git = $this->createMock(GitGateway::class);
        $this->changelog = new Changelog($this->git);
    }

    public function testFirstVersion()
    {
        $this->git->method('getVersions')
            ->willReturn(new Versions(['0.0.1']));
        $this->git->method('getChanges')
            ->with('0.0.1')
            ->willReturn(['Change A', 'Change B']);
        $this->git->method('getDate')
            ->with('0.0.1')
            ->willReturn(new \DateTime('2000-01-02'));

        $expected = implode(
            PHP_EOL,
            [
                '## 0.0.1 - 2000-01-02',
                '- Change A',
                '- Change B',
            ]
        );
        $this->assertEquals(
            $expected,
            $this->changelog->generateForVersion()
        );

        $this->assertEquals(
            $expected,
            $this->changelog->generateForVersion('0.0.1')
        );
    }

    public function testNextVersion()
    {
        $this->git->method('getVersions')
            ->willReturn(new Versions(['0.0.1', '0.0.2']));
        $this->git->method('getChanges')
            ->with('0.0.1', '0.0.2')
            ->willReturn(['Change A', 'Change B']);
        $this->git->method('getDate')
            ->with('0.0.2')
            ->willReturn(new \DateTime('2000-01-02'));
        $this->git->method('getDiffUrl')
            ->with('0.0.1', '0.0.2')
            ->willReturn('https://github.com/foo/bar/compare/0.0.1...0.0.2');

        $expected = implode(
            PHP_EOL,
            [
                '## [0.0.2](https://github.com/foo/bar/compare/0.0.1...0.0.2) - 2000-01-02',
                '- Change A',
                '- Change B',
            ]
        );
        $this->assertEquals(
            $expected,
            $this->changelog->generateForVersion()
        );

        $this->assertEquals(
            $expected,
            $this->changelog->generateForVersion('0.0.2')
        );
    }
}
