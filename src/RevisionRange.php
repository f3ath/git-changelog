<?php
namespace F3\Changelog;

interface RevisionRange
{
    public function getRevSpec(): string;
}
