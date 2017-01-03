<?php
namespace F3\Changelog;

use Composer\Semver\Semver;
use Composer\Semver\VersionParser;

final class Versions
{
    /**
     * @var string[]
     */
    private $versions;

    private function __construct(array $versions)
    {
        if (empty($versions)) {
            throw new \InvalidArgumentException("No versions found");
        }
        $this->versions = Semver::sort($versions);
    }

    public static function fromTags(array $tags): self
    {
        $parser = new VersionParser();
        $versions = array_filter(
            $tags,
            function ($tag) use ($parser) {
                try {
                    $parser->normalize($tag);
                    return $tag;
                } catch (\InvalidArgumentException $e) {
                    return false;
                }
            }
        );
        return new self($versions);
    }

    public function getLast(): string
    {
        return end($this->versions);
    }

    public function isFirst(string $version): bool
    {
        return $version === $this->versions[0];
    }

    public function getPreceding(string $version): string
    {
        $index = array_search($version, $this->versions);
        if ($index === false) {
            throw new \OutOfBoundsException("Version $version not found");
        }
        if ($index === 0) {
            throw new \OutOfRangeException("No preceding version exists");
        }
        return $this->versions[$index - 1];
    }
}
