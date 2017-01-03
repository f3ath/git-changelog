<?php
namespace F3\Changelog;

interface CommitInterface
{
    public function getDate(): \DateTimeInterface;

    public function getSubject(): string;
}
