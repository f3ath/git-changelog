<?php
namespace F3\Changelog;

use F3\Changelog\Git\Commit;
use PHPUnit\Framework\TestCase;

class ChangelogTest extends TestCase
{
    private $git;
    private $changelog;
    private $commits;

    protected function setUp()
    {
        $this->git = $this->createMock(GitInterface::class);
        $this->changelog = new Changelog($this->git, 'origin', new RepositoryFactory());
        $date = new \DateTime('2000-01-02 03:04:05');
        for ($i = 0; $i < 2; $i++) {
            $this->commits[] = new Commit($date, "Commit $i");
        }
    }

    public function testFirstVersion()
    {
        $this->git->method('getTags')
            ->with('origin')
            ->willReturn(['0.0.1']);

        $this->git->method('getCommitsInRange')
            ->with($this->callback(function (RevisionRangeInterface $range) {
                $this->assertEquals('0.0.1', $range->getRevSpec());
                return true;
            }))
            ->willReturn($this->commits);

        $this->git->method('getCommit')
            ->with('0.0.1')
            ->willReturn($this->commits[1]);

        $expected = implode(
            PHP_EOL,
            [
                '## 0.0.1 - 2000-01-02',
                '- Commit 0',
                '- Commit 1',
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
        $this->git->method('getTags')
            ->with('origin')
            ->willReturn(['0.0.1', '0.0.2']);

        $this->git->method('getCommitsInRange')
            ->with($this->callback(function (RevisionRangeInterface $range) {
                $this->assertEquals('0.0.1..0.0.2', $range->getRevSpec());
                return true;
            }))
            ->willReturn($this->commits);

        $this->git->method('getCommit')
            ->with('0.0.2')
            ->willReturn($this->commits[1]);

        $this->git->method('getRemoteUrl')
            ->with('origin')
            ->willReturn('https://github.com/foo/bar.git');

        $expected = implode(
            PHP_EOL,
            [
                '## [0.0.2](https://github.com/foo/bar/compare/0.0.1...0.0.2) - 2000-01-02',
                '- Commit 0',
                '- Commit 1',
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
