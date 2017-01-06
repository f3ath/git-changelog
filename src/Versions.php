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

    public function __construct(array $versions)
    {
        if (empty($versions)) {
            throw new \InvalidArgumentException("No versions found");
        }
        $this->versions = Semver::sort(array_values($versions));
    }

    public static function fromTags(array $tags): self
    {
        $parser = new VersionParser();
        return new self(
            array_filter(
                $tags,
                function ($tag) use ($parser) {
                    try {
                        $parser->normalize($tag);
                        return true;
                    } catch (\UnexpectedValueException $e) {
                        return false;
                    }
                }
            )
        );
    }

    public function getLast(): string
    {
        return end($this->versions);
    }

    public function getFirst(): string
    {
        return reset($this->versions);
    }

    public function getPreceding(string $version): string
    {
        $index = array_search($version, $this->versions);
        if ($index === false) {
            throw new \OutOfBoundsException("Version $version not found");
        } elseif ($index === 0) {
            throw new \OutOfRangeException("No preceding version exists");
        }
        return $this->versions[$index - 1];
    }
}
