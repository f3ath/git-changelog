<?php
namespace F3\Changelog\Git;

class RepoDetector
{
    public function getDiffUrl(string $remoteUrl, string $from, $to): string
    {
        $regExp = '#^(git@github.com:|https://github.com/)(?P<org>[\w_-]+)/(?P<repo>[\w_-]+).git$#';

        if (preg_match($regExp, $remoteUrl, $m)) {
            return "https://github.com/{$m['org']}/{$m['repo']}/compare/{$from}...{$to}";
        }

        throw new \UnexpectedValueException("Can not parse remote: $remoteUrl. ");
    }
}
