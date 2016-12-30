<?php
namespace F3\Changelog\Git;

use PHPUnit\Framework\TestCase;

class RepoDetectorTest extends TestCase
{
    public function urlDataProvider(): array
    {
        return [
            [
                'https://github.com/foo/bar/compare/a...b',
                'https://github.com/foo/bar.git',
            ],
            [
                'https://github.com/foo/bar/compare/a...b',
                'https://github.com/foo/bar',
            ],
            [
                'https://github.com/f3ath/git-changelog/compare/a...b',
                'git@github.com:f3ath/git-changelog.git',
            ],
        ];
    }

    /**
     * @param string $expected
     * @param string $url

     * @dataProvider urlDataProvider
     */
    public function testGithub(string $expected, string $url)
    {
        $detector = new RepoDetector();
        $this->assertEquals($expected, $detector->getDiffUrl($url, 'a', 'b'));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidUrl()
    {
        $detector = new RepoDetector();
        $detector->getDiffUrl('https://google.com', 'a', 'b');
    }
}
