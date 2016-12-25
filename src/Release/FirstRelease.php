<?php
namespace F3\Changelog\Release;

use F3\Changelog\GitGateway;
use F3\Changelog\Printer;
use F3\Changelog\Release;

final class FirstRelease implements Release
{
    /**
     * @var string
     */
    protected $tag;
    /**
     * @var GitGateway
     */
    private $git;

    public function __construct(GitGateway $git, string $tag)
    {
        $this->tag = $tag;
        $this->git = $git;
    }

    public function printHeader(Printer $printer)
    {
        $printer->printHeader(
            $this->tag,
            $this->git->getCommitDate($this->tag)
        );
    }

    public function printChanges(Printer $printer)
    {
        foreach ($this->git->getRevisionsTo($this->tag) as $commit) {
            $printer->printChange(
                $commit->subject()
            );
        };
    }
}
