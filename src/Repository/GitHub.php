<?php
namespace F3\Changelog\Repository;

use F3\Changelog\RepositoryInterface;

class GitHub implements RepositoryInterface
{
    private $org;
    private $repo;

    public function __construct(string $org, string $repo)
    {
        $this->org = $org;
        $this->repo = $repo;
    }

    public function getDiffUrl(string $tag1, string $tag2): string
    {
        return sprintf(
            'https://github.com/%s/%s/compare/%s...%s',
            ...array_map('urlencode', [$this->repo, $this->org, $tag1, $tag2])
        );
    }
}
