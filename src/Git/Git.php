<?php
namespace F3\Changelog\Git;

use F3\Changelog\CommitInterface;
use F3\Changelog\GitInterface;
use F3\Changelog\RevisionRangeInterface;

class Git implements GitInterface
{
    /**
     * @var callable
     */
    private $shell;

    public function __construct(callable $shell = null)
    {
        $this->shell = $shell ?: function (string $command) {
            var_dump($command);
            var_dump(`$command`);
            return `$command`;
        };
    }

    public function getTags(string $remote): array
    {
        return array_map(
            function (string $line) {
                return preg_replace('#^\w+\srefs/tags/#', '', $line);
            },
            $this->execGetArray("git ls-remote -q -t {$remote}")
        );
    }

    public function getRemoteUrl(string $remote): string
    {
        return $this->execGetString("git remote get-url {$remote}");
    }

    public function getCommitsInRange(RevisionRangeInterface $range): array
    {
        return array_map(
            function (string $log_entry) {
                return Commit::fromLogEntry(
                    $this->parseLogEntry($log_entry)
                );
            },
            $this->execGetArray("git log --format='%aI::%s' {$range->getRevSpec()} --")
        );
    }

    public function getCommit(string $revision): CommitInterface
    {
        return Commit::fromLogEntry(
            $this->parseLogEntry(
                $this->execGetString("git show -q --format='%aI::%s' {$revision} --")
            )
        );
    }

    private function parseLogEntry(string $log_entry): array
    {
        return array_combine(
            ['date', 'subject'],
            explode('::', $log_entry, 2)
        );
    }

    private function execGetString(string $command): string
    {
        return trim(($this->shell)($command));
    }

    private function execGetArray(string $command): array
    {
        return array_filter(explode(PHP_EOL, $this->execGetString($command)));
    }
}
