<?php
namespace F3\Changelog\Cli;

use F3\Changelog\Exception\FileNotFound;
use F3\Changelog\Exception\InvalidConfigFile;

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

    public static function fromJsonFile(string $json_file): self
    {
        if (!file_exists($json_file)) {
            throw new FileNotFound($json_file);
        }
        $json = file_get_contents($json_file);
        $conf = json_decode($json, true);
        if (is_array($conf)) {
            return new self($conf);
        }
        throw new InvalidConfigFile("Invalid config");
    }

    public static function fromJsonFileIgnoreMissing(string $json_file): self
    {
        try {
            return self::fromJsonFile($json_file);
        } catch (FileNotFound $e) {
            return new self;
        }
    }
}
