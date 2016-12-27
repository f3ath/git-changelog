<?php
namespace F3\Changelog\Cli;

class ArgvInput implements Input
{
    /**
     * @var array
     */
    private $argv;

    public function __construct(array $argv)
    {
        $this->argv = $argv;
    }

    /**
     * Get requested tag
     * @return string|null
     */
    public function getTag()
    {
        return $this->argv[1] ?? null;
    }
}
