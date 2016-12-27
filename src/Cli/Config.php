<?php
namespace F3\Changelog\Cli;

final class Config extends \ArrayObject
{
    public function __construct(array $conf = [])
    {
        parent::__construct(
            array_merge(
                [
                    'remote' => 'origin',
                ],
                $conf
            )
        );
    }

    public static function fromJsonFile(string $json_file = '.release-notes.json', bool $ignore_missing = true): self
    {
        if (file_exists($json_file)) {
            $json = file_get_contents($json_file);
            $conf = json_decode($json, true);
            if (!is_array($conf)) {
                throw new \RuntimeException("Invalid config");
            }
            return new self($conf);
        }
        if ($ignore_missing) {
            return new self();
        }
        throw new \RuntimeException("Configuration not found");
    }
}
