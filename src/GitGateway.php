<?php
namespace F3\Changelog;

use F3\Changelog\Git\Commit;
use F3\Changelog\Git\Git;
use F3\Changelog\RevisionRange\RevisionsBetween;
use F3\Changelog\RevisionRange\RevisionsTo;

class GitGateway
{
    /**
     * @var Git
     */
    private $git;

    /**
     * @var string
     */
    private $remote;

    /**
     * @var RemoteFactory
     */
    private $remote_factory;

    public function __construct(Git $git, $remote, RemoteFactory $remote_factory)
    {
        $this->git = $git;
        $this->remote = $remote;
        $this->remote_factory = $remote_factory;
    }


    public function getVersions(): Versions
    {
        return Versions::fromTags($this->git->getTags($this->remote));
    }

    public function getDate(string $revision): \DateTimeInterface
    {
        return $this->git->getCommit($revision)->getDate();
    }

    /**
     * @param string $rev1
     * @param string $rev2
     * @return string[]
     */
    public function getChanges(string $rev1, string $rev2 = null): array
    {
        return array_map(
            function (Commit $commit):string {
                return $commit->getSubject();
            },
            $this->git->getCommitsInRange($rev2 === null ? new RevisionsTo($rev1) : new RevisionsBetween($rev1, $rev2))
        );
    }

    public function getDiffUrl(string $rev1, string $rev2): string
    {
        $remote_url = $this->git->getRemoteUrl($this->remote);
        $remote = $this->remote_factory->createByUrl($remote_url);
        return $remote->getDiffUrl($rev1, $rev2);
    }
}
