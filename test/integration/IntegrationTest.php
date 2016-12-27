<?php
namespace Test\Integration;

use F3\Changelog\Cli\Application;
use F3\Changelog\Cli\Config;
use F3\Changelog\Cli\Input;
use F3\Changelog\Cli\StdOutput;
use F3\Changelog\Generator;
use F3\Changelog\Git\RepoDetector;
use F3\Changelog\Git\Shell;
use F3\Changelog\Git\ShellGit;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    private $app;
    private $shell;

    protected function setUp()
    {
        $this->shell = $this->createMock(Shell::class);
        $config = new Config();
        $this->app = new Application(
            new Generator(
                new ShellGit($config['remote'], $this->shell, new RepoDetector())
            )
        );
    }

    public function testLastTag()
    {
        $this->shell->method('exec')
            ->willReturnMap(
                require __DIR__ . '/without_tag.php'
            );
        $input = $this->createMock(Input::class);
        ob_start();
        $this->app->run($input, new StdOutput());
        $output = ob_get_contents();
        ob_end_clean();
        $expected = <<<EXPECTED

## [0.0.3](https://github.com/f3ath/git-changelog/compare/0.0.2...0.0.3) - 2016-12-26
- Drop hhvm (#2)
- RepoDetector tests
- Update README.md
- Travis and phpcs
- Update README.md
- Update README.md
- Update README.md
- Update README.md
- Added: Another README example


EXPECTED;

        $this->assertEquals($expected, $output);
    }

    public function testFirstTag()
    {
        $this->shell->method('exec')
            ->willReturnMap(
                require __DIR__ . '/with_first_tag.php'
            );
        $input = $this->createMock(Input::class);
        $input->method('getTag')->willReturn('0.0.1');
        ob_start();
        $this->app->run($input, new StdOutput());
        $output = ob_get_contents();
        ob_end_clean();
        $expected = <<<EXPECTED

## [0.0.1] - 2016-12-24
- Merge branch 'master' of github.com:f3ath/git-changelog
- RepoDetector fix
- Update README.md
- composer binary
- Initial commit


EXPECTED;

        $this->assertEquals($expected, $output);
    }

    public function testSecondTag()
    {
        $this->shell->method('exec')
            ->willReturnMap(
                require __DIR__ . '/with_second_tag.php'
            );
        $input = $this->createMock(Input::class);
        $input->method('getTag')->willReturn('0.0.2');
        ob_start();
        $this->app->run($input, new StdOutput());
        $output = ob_get_contents();
        ob_end_clean();
        $expected = <<<EXPECTED

## [0.0.2](https://github.com/f3ath/git-changelog/compare/0.0.1...0.0.2) - 2016-12-24
- Added: README example


EXPECTED;

        $this->assertEquals($expected, $output);
    }

}
