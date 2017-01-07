<?php
namespace F3\Changelog;

use F3\Changelog\Git\Commit;
use F3\Changelog\Git\Git;
use F3\Changelog\Shell\Output;
use F3\Changelog\Shell\Shell;
use PHPUnit\Framework\TestCase;

class GitTest extends TestCase
{
    private $shell;

    /**
     * @var Git
     */
    private $git;

    protected function setUp()
    {
        $this->shell = $this->createMock(Shell::class);
        $this->git = new Git($this->shell);
    }

    public function testGetTags()
    {
        $this->shell->method('exec')
            ->with('git ls-remote -q -t remote_name')
            ->willReturn(new Output([
                '9b0d23d15dc2b1f64f671f06bb3d7e634df6a5ed	refs/tags/0.0.1',
                'a913160e9c33639de4f9a87a3812ad9130885150	refs/tags/0.0.2',
                'ef4285d08081b49437c0c1d11891cbe621e25ce1	refs/tags/0.0.3',
            ]));
        $this->assertEquals(
            ['0.0.1', '0.0.2', '0.0.3'],
            $this->git->getTags('remote_name')
        );
    }

    public function testGetRemoteUrl()
    {
        $this->shell->method('exec')
            ->with('git remote get-url remote_name')
            ->willReturn(new Output([
                'git@github.com:f3ath/git-changelog.git',
            ]));
        $this->assertEquals(
            'git@github.com:f3ath/git-changelog.git',
            $this->git->getRemoteUrl('remote_name')
        );
    }

    public function testGetCommit()
    {
        $this->shell->method('exec')
            ->with('git show -q --format=\'%aI::%s\' rev --')
            ->willReturn(new Output([
                '2017-01-06T00:57:49-08:00::Initial commit',
            ]));
        $commit = $this->git->getCommit('rev');
        $this->assertInstanceOf(Commit::class, $commit);
        $this->assertEquals('Initial commit', $commit->getSubject());
        $this->assertEquals('2017-01-06', $commit->getDate()->format('Y-m-d'));
    }

    public function testGetCommitsInRange()
    {
        $this->shell->method('exec')
            ->with('git log --format=\'%aI::%s\' foo --')
            ->willReturn(new Output([
                '2017-01-06T00:57:49-08:00::Initial commit',
                '2017-01-07T00:57:49-08:00::Next commit',
            ]));
        $range = $this->createMock(RevisionRangeInterface::class);
        $range->method('getRevSpec')->willReturn('foo');

        list($c1, $c2) = $this->git->getCommitsInRange($range);

        $this->assertInstanceOf(Commit::class, $c1);
        $this->assertInstanceOf(Commit::class, $c2);
        $this->assertEquals('Initial commit', $c1->getSubject());
        $this->assertEquals('Next commit', $c2->getSubject());
        $this->assertEquals('2017-01-06', $c1->getDate()->format('Y-m-d'));
        $this->assertEquals('2017-01-07', $c2->getDate()->format('Y-m-d'));
    }

}