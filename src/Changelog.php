<?php
namespace F3\Changelog;

use F3\Changelog\RevisionRange\RevisionsBetween;
use F3\Changelog\RevisionRange\RevisionsTo;

final class Changelog
{
    /**
     * @var GitInterface
     */
    private $git;

    /**
     * @var string
     */
    private $remote;

    /**
     * @var RepositoryFactoryInterface
     */
    private $repo_factory;

    public function __construct(GitInterface $git, string $remote, RepositoryFactoryInterface $repo_factory)
    {
        $this->git = $git;
        $this->remote = $remote;
        $this->repo_factory = $repo_factory;
    }

    public static function fromConfig(array $config):self
    {
        return new self(
            new $config['git'],
            $config['remote'],
            new $config['repo_factory']
        );
    }

    public function generateForVersion(string $version = null): string
    {
        $versions = Versions::fromTags($this->git->getTags($this->remote));
        $version = $version ?: $versions->getLast();
        if ($versions->isFirst($version)) {
            $release_formatted = $version;
            $rev_range = new RevisionsTo($version);
        } else {
            $preceding_version = $versions->getPreceding($version);
            $url = $this->getDiffUrl($preceding_version, $version);
            $release_formatted = "[$version]($url)";
            $rev_range = new RevisionsBetween($preceding_version, $version);
        }
        $output = [];
        $date = $this->git->getCommit($version)->getDate()->format('Y-m-d');
        $output[] = "## $release_formatted - $date";
        foreach ($this->git->getCommitsInRange($rev_range) as $commit) {
            $output[] = sprintf('- %s', $commit->getSubject());
        }
        return implode(PHP_EOL, $output);
    }

    private function getDiffUrl(string $tag1, string $tag2): string
    {
        return $this->repo_factory
            ->getByUrl($this->git->getRemoteUrl($this->remote))
            ->getDiffUrl($tag1, $tag2);
    }
}
