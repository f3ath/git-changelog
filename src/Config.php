<?php
namespace F3\Changelog;

use F3\Changelog\Git\Git;

final class Config
{
    const DEFAULT = [
        'remote'       => 'origin',
        'git'          => Git::class,
        'repo_factory' => RepositoryFactory::class,
    ];

    public static function fromJsonFile(string $json_file): array
    {
        if (!file_exists($json_file)) {
            return self::DEFAULT;
        }
        $conf = json_decode(file_get_contents($json_file), true);
        if (is_array($conf)) {
            return array_merge(self::DEFAULT, $conf);
        }
        throw new \RuntimeException('JSON config file must contain a valid JSON object');
    }
}
