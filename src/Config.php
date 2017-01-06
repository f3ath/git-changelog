<?php
namespace F3\Changelog;

final class Config
{
    const DEFAULT = [
        'remote' => 'origin',
    ];

    private $conf;

    public function __construct(array $conf = [])
    {
        $this->conf = array_merge(self::DEFAULT, $conf);
    }

    public static function fromJsonFile(string $json_file): self
    {
        if (!file_exists($json_file)) {
            return new self();
        }
        $conf = json_decode(file_get_contents($json_file), true);
        if (is_array($conf)) {
            return new self($conf);
        }
        throw new \RuntimeException('JSON config file must contain a valid JSON object');
    }

    public function getRemoteName(): string
    {
        return $this->conf['remote'];
    }
}
