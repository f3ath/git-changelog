<?php
namespace F3\Changelog\RevisionRange;

use F3\Changelog\RevisionRangeInterface;

class RevisionsBetween implements RevisionRangeInterface
{
    private $from;
    private $to;

    public function __construct(string $from, string $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function getRevSpec(): string
    {
        return "{$this->from}..{$this->to}";
    }
}
