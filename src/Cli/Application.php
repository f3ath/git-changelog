<?php
namespace F3\Changelog\Cli;

use F3\Changelog\Generator;
use F3\Changelog\Git\Git;

class Application
{
    /**
     * @var Generator
     */
    private $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public static function build(): self
    {
        $conf = Config::fromJsonFile();
        return new self(new Generator(new Git($conf['remote'])));
    }

    public function run(Input $input, Output $output)
    {
        $printer = new MarkdownPrinter($output);
        $release = $this->generator->getRelease($input->getTag());
        $output->writeln('');
        $release->printHeader($printer);
        $release->printChanges($printer);
        $output->writeln('');
    }
}
