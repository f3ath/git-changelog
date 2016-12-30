<?php
namespace F3\Changelog\Git;

class RepoDetector
{
    public function getDiffUrl(string $remote_url, string $from, $to): string
    {
        $patterns = [
            '#^git@github.com:(?P<org>[\w_-]+)/(?P<repo>[\w_-]+).git$#',
            '#^https://github.com/(?P<org>[\w_-]+)/(?P<repo>[\w_-]+)(.git)?$#'
        ];
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $remote_url, $match)) {
                return "https://github.com/{$match['org']}/{$match['repo']}/compare/{$from}...{$to}";
            }
        }
        throw new \UnexpectedValueException("Can not parse remote: $remote_url. ");
    }
}
