<?php
namespace F3\Changelog\Git;

use F3\Changelog\CommitInterface;

class GitTest extends \PHPUnit_Framework_TestCase
{
    private $command;
    private $response;

    public function testGit()
    {
        $git = new Git(
            function (string $command) {
                $this->command = $command;
                return $this->response;
            }
        );

        $this->response = '2016-12-26T23:25:09-08:00::Drop hhvm (#2)';
        $commit = $git->getCommit('xxx');
        $this->assertInstanceOf(CommitInterface::class, $commit);
        $this->assertEquals('2016-12-26', $commit->getDate()->format('Y-m-d'));
        $this->assertEquals('Drop hhvm (#2)', $commit->getSubject());
        $this->assertEquals("git show -q --format='%aI::%s' xxx --", $this->command);
    }
}
