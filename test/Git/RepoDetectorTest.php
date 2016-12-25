<?php
namespace F3\Changelog\Git;

class RepoDetectorTest extends \PHPUnit_Framework_TestCase
{
    public function testGithub()
    {
        $detector = new RepoDetector();
        $this->assertEquals(
            'https://github.com/foo/bar/compare/a...b',
            $detector->getDiffUrl('https://github.com/foo/bar.git', 'a', 'b')
        );
    }

}
