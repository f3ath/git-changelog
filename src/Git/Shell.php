<?php
namespace F3\Changelog\Git;

class Shell
{
    public function exec(string $command): array
    {
        exec($command, $output, $code);
        if (0 === $code) {
            return $output;
        }
        throw new ShellExecException($command, $code);
    }
}
