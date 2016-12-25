<?php
namespace F3\Changelog\Git;

use F3\Changelog\GitGateway;

final class Git implements GitGateway
{
    /**
     * @var Shell
     */
    private $shell;

    /**
     * @var RepoDetector
     */
    private $detector;

    /**
     * @var string
     */
    private $remote;

    public function __construct(string $remote = 'origin', Shell $shell = null, RepoDetector $detector = null)
    {
        $this->remote = $remote;
        $this->shell = $shell ?? new Shell();
        $this->detector = $detector ?? new RepoDetector();
    }

    public function getCommitDate(string $revision): \DateTimeInterface
    {
        return \DateTimeImmutable::createFromFormat(
            DATE_RFC2822,
            $this->getCommitDetail($revision, 'aD')
        );
    }

    public function getTags(): array
    {
        return array_filter(
            array_map(
                function (string $line) {
                    return preg_replace('#^\w+\srefs/tags/#', '', $line);
                },
                $this->shell->exec("git ls-remote --tags {$this->remote}")
            ),
            function (string $line) {
                return $line !== '';
            }
        );
    }

    public function getDiffUrl(string $from, string $to): string
    {
        return $this->detector->getDiffUrl(
            $this->arrayToString($this->shell->exec("git remote get-url {$this->remote}")),
            $from,
            $to
        );
    }

    public function getRevisionsTo(string $revision): array
    {
       return $this->getRevisions($revision);
    }

    public function getRevisionsBetween(string $from, string $to): array
    {
        return $this->getRevisions("$from..$to");
    }

    /**
     * @param string $rev_spec
     * @return Commit[]
     */
    private function getRevisions(string $rev_spec): array
    {
        $entries = $this->shell->exec("git log --pretty=\"format:%H;%aI;%s\" {$rev_spec}");

        return array_map(function (string $line) {
            $parsedEntry = array_combine(['hash', 'date', 'subject'], explode(';', $line, 3));

            return Commit::fromLogEntry($parsedEntry);
        }, $entries);
    }

    private function getCommitDetail(string $revision, string $format): string
    {
        return $this->arrayToString($this->shell->exec("git show -q --format='%$format' $revision --"));
    }

    private function arrayToString(array $lines): string
    {
        return trim(implode(PHP_EOL, $lines));
    }
}
