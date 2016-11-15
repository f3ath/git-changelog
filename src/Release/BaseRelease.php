<?php
namespace F3\Changelog\Release;

use F3\Changelog\GitGateway;
use F3\Changelog\Printer;
use F3\Changelog\Release;

abstract class BaseRelease implements Release
{
    /**
     * @var GitGateway
     */
    protected $git;

    public function __construct(GitGateway $git)
    {
        $this->git = $git;
    }

    protected function printRevision(Printer $printer, string $revision)
    {
        $printer->printChange(
            $this->git->getCommitSubject($revision)
        );
    }
}
