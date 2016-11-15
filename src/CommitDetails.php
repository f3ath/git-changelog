<?php
namespace F3\Changelog;

interface CommitDetails
{
    public function getDate(): \DateTimeInterface;
    public function getSubject(): string;
    public function getAuthor(): string;
}
