<?php
namespace F3\Changelog\Shell;

class Output
{
    private $lines;

    public function __construct($lines)
    {
        $this->lines = $lines;
    }

    public function getString():string
    {
        return implode(PHP_EOL, $this->lines);
    }

    public function getLines(): array
    {
        return $this->lines;
    }
}
