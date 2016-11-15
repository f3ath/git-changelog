<?php
namespace F3\Changelog;

interface Printer
{
    public function printHeader(string $tag, \DateTimeInterface $date);
    public function printHeaderWIthLink(string $tag, \DateTimeInterface $date, string $url);
    public function printChange(string $subject);
}
