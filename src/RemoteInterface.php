<?php
namespace F3\Changelog;

interface RemoteInterface
{
    public function getDiffUrl(string $rev1, string $rev2): string;
}
