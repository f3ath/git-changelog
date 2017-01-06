<?php
namespace F3\Changelog;

final class Changelog
{
    /**
     * @var GitGateway
     */
    private $git;

    public function __construct(GitGateway $git)
    {
        $this->git = $git;
    }

    public function generateForVersion(string $version = null): string
    {
        $versions = $this->git->getVersions();
        $version = $version ?: $versions->getLast();
        if ($versions->getFirst() === $version) {
            $release_formatted = $version;
            $changes = $this->git->getChanges($version);
        } else {
            $preceding_version = $versions->getPreceding($version);
            $url = $this->git->getDiffUrl($preceding_version, $version);
            $release_formatted = "[$version]($url)";
            $changes = $this->git->getChanges($preceding_version, $version);
        }
        $output = [];
        $date = $this->git->getDate($version)->format('Y-m-d');
        $output[] = "## $release_formatted - $date";
        foreach ($changes as $change) {
            $output[] = sprintf('- %s', $change);
        }
        return implode(PHP_EOL, $output);
    }
}
