<?php
namespace F3\Changelog;

interface GitInterface
{
    /**
     * @param string $remote
     * @return string[]
     */
    public function getTags(string $remote): array;

    public function getRemoteUrl(string $remote): string;

    /**
     * @param RevisionRangeInterface $range
     * @return CommitInterface[]
     */
    public function getCommitsInRange(RevisionRangeInterface $range): array;

    public function getCommit(string $revision): CommitInterface;
}
