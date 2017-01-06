<?php
namespace F3\Changelog\Shell;

class Shell
{
    public function exec(string $command): Output
    {
        exec($command, $lines, $code);
        if ($code === 0) {
            return new Output($lines);
        }
        throw new \RuntimeException("Command exited with code $code: $command", $code);
    }
}
