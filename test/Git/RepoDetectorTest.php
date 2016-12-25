<?php
namespace F3\Changelog\Git;

class RepoDetectorTest extends \PHPUnit_Framework_TestCase
{
    private $detector;

    public function setUp()
    {
        $this->detector = new RepoDetector();
    }

    /**
     * @dataProvider positiveCasesProvider
     */
    public function test_positive_cases_for_url_parsing($repoUrl, $tags, $result)
    {
        $this->assertEquals(
            $result,
            $this->detector->getDiffUrl($repoUrl, ...$tags)
        );
    }

    /**
     * @dataProvider negativeCasesProvider
     * @expectedException \UnexpectedValueException
     */
    public function test_negative_cases_for_url_parsing($url)
    {
        $this->detector->getDiffUrl($url, 'a', 'b');
    }

    public function positiveCasesProvider()
    {
        return [
            [
                'https://github.com/foo/bar.git',
                ['a', 'b'],
                'https://github.com/foo/bar/compare/a...b'
            ],
            [
                'git@github.com:foo/bar.git',
                ['a', 'b'],
                'https://github.com/foo/bar/compare/a...b'
            ]
        ];
    }

    public function negativeCasesProvider()
    {
        return [
            ['git@gitlab.com:fail'],
            ['https://google.com']
        ];
    }
}
