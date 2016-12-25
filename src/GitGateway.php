<?php
namespace F3\Changelog;

use F3\Changelog\Git\Commit;

interface GitGateway
{
    public function getCommitDate(string $revision): \DateTimeInterface;

    /**
     * Get list of tags
     *
     * @return string[]
     */
    public function getTags(): array;

    /**
     * Get the url show the diff between revisions

     * @param string $from
     * @param string $to
     * @return string
     */
    public function getDiffUrl(string $from, string $to): string;

    /**
     * Get all revisions up to $revision
     *
     * @param string $revision
     * @return Commit[]
     */
    public function getRevisionsTo(string $revision): array;

    /**
     * Get all revisions between $from and $to
     *
     * @param string $from
     * @param string $to
     * @return Commit[]
     */
    public function getRevisionsBetween(string $from, string $to): array;
}
