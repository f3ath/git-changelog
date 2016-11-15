<?php
namespace F3\Changelog\Git;

class RepoDetector
{
    public function getDiffUrl(string $remote_url, string $from, $to): string
    {
        if (
            preg_match('#^git@github.com:(?P<org>[\w_-]+)/(?P<repo>[\w_-]+).git$#', $remote_url, $m)
            || preg_match('#^https://github.com/(?P<org>[\w_-]+)/(?P<repo>[\w_-]+)$#', $remote_url, $m)
        ) {
            return "https://github.com/{$m['org']}/{$m['repo']}/compare/{$from}...{$to}";
        } else {
            throw new \UnexpectedValueException("Can not parse remote: $remote_url. ");
        }
    }
}
