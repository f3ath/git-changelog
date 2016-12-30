<?php
namespace F3\Changelog\Cli;

use F3\Changelog\Generator;

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
