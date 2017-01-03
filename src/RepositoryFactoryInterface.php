<?php
namespace F3\Changelog;

interface RepositoryFactoryInterface
{
    public function getByUrl(string $url): RepositoryInterface;
}
