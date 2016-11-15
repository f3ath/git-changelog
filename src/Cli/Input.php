<?php
namespace F3\Changelog\Cli;

interface Input
{
    /**
     * Get requested tag
     * @return string|null
     */
    public function getTag();
}
