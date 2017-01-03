<?php
namespace F3\Changelog;

use F3\Changelog\Repository\GitHub;

class RepositoryFactory implements RepositoryFactoryInterface
{
    public function getByUrl(string $url): RepositoryInterface
    {
        $patterns = [
            '#^git@github.com:(?P<org>[\w_-]+)/(?P<repo>[\w_-]+).git$#',
            '#^https://github.com/(?P<org>[\w_-]+)/(?P<repo>[\w_-]+)(.git)?$#'
        ];
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $match)) {
                return new GitHub($match['repo'], $match['org']);
            }
        }
        throw new \UnexpectedValueException("Unknown remote URL $url.");
    }
}
