<?php
namespace F3\Changelog\Cli;

class StdOutput implements Output
{
    public function writeln(string $str)
    {
        echo $str . PHP_EOL;
    }
}
