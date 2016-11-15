<?php
namespace F3\Changelog;

use Composer\Semver\Semver;
use F3\Changelog\Exception\NoTagsFound;
use F3\Changelog\Exception\TagNotFound;
use F3\Changelog\Release\FirstRelease;
use F3\Changelog\Release\SubsequentRelease;

class Generator
{
    /**
     * @var GitGateway
     */
    private $git;

    public function __construct(GitGateway $git)
    {
        $this->git = $git;
    }

    public function getRelease(string $tag): Release
    {
        $tags = $this->git->getTags();
        if (empty($tags)) {
            throw new NoTagsFound();
        }
        $tags = Semver::rsort($tags);
        $tag = $tag ?: reset($tags);
        $index = array_search($tag, $tags);
        if (false === $index) {
            throw new TagNotFound($tag);
        }
        if (++$index < count($tags)) {
            return new SubsequentRelease($this->git, $tags[$index], $tag);
        }
        return new FirstRelease($this->git, $tag);
    }

}
