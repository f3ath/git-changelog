<?php

namespace F3\Changelog\Git;

use PHPUnit\Framework\TestCase;

class CommitTest extends TestCase
{
    public function test_parse_from_entry_log()
    {
        $commit = Commit::fromLogEntry([
            'hash' => 'hash123123',
            'date' => '2016-12-24T17:29:10-00:00',
            'subject' => 'test commit'
        ]);

        self::assertEquals('hash123123', (string) $commit);
        self::assertEquals('hash123123', $commit->hash());
        self::assertInstanceOf(\DateTimeInterface::class, $commit->date());
        self::assertEquals('test commit', $commit->subject());
    }
}
