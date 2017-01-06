<?php
namespace F3\Changelog\Git;

use F3\Changelog\RevisionRange;
use F3\Changelog\Shell\Shell;

class Git
{
    /**
     * @var Shell
     */
    private $shell;

    public function __construct(Shell $shell)
    {
        $this->shell = $shell;
    }

    /**
     * @param string $remote
     * @return string[]
     */
    public function getTags(string $remote): array
    {
        return array_map(
            function (string $line) {
                return preg_replace('#^\w+\srefs/tags/#', '', $line);
            },
            $this->shell->exec("git ls-remote -q -t {$remote}")
                ->getLines()
        );
    }

    public function getRemoteUrl(string $remote): string
    {
        return $this->shell->exec("git remote get-url {$remote}")->getString();
    }

    /**
     * @param RevisionRange $range
     * @return Commit[]
     */
    public function getCommitsInRange(RevisionRange $range): array
    {
        return array_map(
            function (string $log_entry) {
                return Commit::fromLogEntry(
                    $this->parseLogEntry($log_entry)
                );
            },
            array_filter(
                $this->shell->exec("git log --format='%aI::%s' {$range->getRevSpec()} --")
                    ->getLines()
            )
        );
    }

    public function getCommit(string $revision): Commit
    {
        return Commit::fromLogEntry(
            $this->parseLogEntry(
                $this->shell->exec("git show -q --format='%aI::%s' {$revision} --")
                    ->getString()
            )
        );
    }

    private function parseLogEntry(string $log_entry): array
    {
        return array_combine(
            ['date', 'subject'],
            explode('::', trim($log_entry), 2)
        );
    }
}
