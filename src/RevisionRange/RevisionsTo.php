<?php
namespace F3\Changelog\RevisionRange;

use F3\Changelog\RevisionRangeInterface;

class RevisionsTo implements RevisionRangeInterface
{
    private $rev;

    public function __construct(string $rev)
    {
        $this->rev = $rev;
    }

    public function getRevSpec(): string
    {
        return $this->rev;
    }
}
