<?php
namespace F3\Changelog\Release;

use F3\Changelog\GitGateway;
use F3\Changelog\Printer;
use F3\Changelog\Release;

final class FirstRelease implements Release
{
    /**
     * @var GitGateway
     */
    private $git;

    /**
     * @var string
     */
    protected $tag;

    public function __construct(GitGateway $git, string $tag)
    {
        $this->git = $git;
        $this->tag = $tag;
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
        foreach ($this->git->getRevisionsTo($this->tag) as $revision) {
            $printer->printChange(
                $this->git->getCommitSubject($revision)
            );
        };
    }
}
