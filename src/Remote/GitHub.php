<?php
namespace F3\Changelog\Remote;

use F3\Changelog\RemoteInterface;

class GitHub implements RemoteInterface
{
    private $org;
    private $repo;

    public function __construct(string $org, string $repo)
    {
        $this->org = $org;
        $this->repo = $repo;
    }

    public function getDiffUrl(string $rev1, string $rev2): string
    {
        return sprintf(
            'https://github.com/%s/%s/compare/%s...%s',
            ...array_map('urlencode', [$this->repo, $this->org, $rev1, $rev2])
        );
    }
}
