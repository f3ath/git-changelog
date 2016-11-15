<?php
namespace F3\Changelog;

interface Release
{
    public function printHeader(Printer $printer);
    public function printChanges(Printer $printer);
}
