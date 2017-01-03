<?php
namespace F3\Changelog;

interface RepositoryInterface
{
    public function getDiffUrl(string $tag1, string $tag2): string;
}
