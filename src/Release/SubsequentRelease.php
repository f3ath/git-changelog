<?php
namespace F3\Changelog\Release;

use F3\Changelog\GitGateway;
use F3\Changelog\Printer;
use F3\Changelog\Release;

final class SubsequentRelease implements Release
{
    /**
     * @var string
     */
    private $prev_tag;

    /**
     * @var string
     */
    private $tag;
    /**
     * @var GitGateway
     */
    private $git;

    public function __construct(GitGateway $git, string $prev_tag, string $tag)
    {
        $this->prev_tag = $prev_tag;
        $this->tag = $tag;
        $this->git = $git;
    }

    public function printHeader(Printer $printer)
    {
        $printer->printHeaderWIthLink(
            $this->tag,
            $this->git->getCommitDate($this->tag),
            $this->git->getDiffUrl($this->prev_tag, $this->tag)
        );
    }

    public function printChanges(Printer $printer)
    {
        foreach ($this->git->getRevisionsBetween($this->prev_tag, $this->tag) as $revision) {
            $printer->printChange(
                $this->git->getCommitSubject($revision)
            );
        }
    }
}
