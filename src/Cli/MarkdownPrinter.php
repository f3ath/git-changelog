<?php
namespace F3\Changelog\Cli;

use F3\Changelog\Printer;

class MarkdownPrinter implements Printer
{
    const DATE_FORMAT = 'Y-m-d';

    /**
     * @var Output
     */
    private $output;

    public function __construct(Output $output)
    {
        $this->output = $output;
    }

    public function printHeader(string $tag, \DateTimeInterface $date)
    {
        $date_string = $date->format(self::DATE_FORMAT);
        $this->output->writeln("## [$tag] - $date_string");
    }

    public function printHeaderWIthLink(string $tag, \DateTimeInterface $date, string $url)
    {
        $date_string = $date->format(self::DATE_FORMAT);
        $this->output->writeln("## [$tag]($url) - $date_string");
    }

    public function printChange(string $subject)
    {
        $this->output->writeln("- $subject");
    }
}
