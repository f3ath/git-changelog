<?php
namespace F3\Changelog\Release;

use F3\Changelog\GitGateway;
use F3\Changelog\Printer;

final class FirstRelease extends BaseRelease
{
    /**
     * @var string
     */
    protected $tag;

    public function __construct(GitGateway $git, string $tag)
    {
        parent::__construct($git);
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
            $this->printRevision($printer, $revision);
        };
    }
}
