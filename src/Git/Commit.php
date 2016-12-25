<?php

namespace F3\Changelog\Git;

class Commit
{
    /**
     * @var string
     */
    private $hash;

    /**
     * @var \DateTIme
     */
    private $date;

    /**
     * @var string
     */
    private $subject;

    public static function fromLogEntry(array $logEntry): self
    {
        $commit = new self();
        $commit->hash = $logEntry['hash'];
        $commit->date = \DateTime::createFromFormat(\DateTime::RFC3339, $logEntry['date']);
        $commit->subject = $logEntry['subject'];

        return $commit;
    }

    /**
     * @return string
     */
    public function hash(): string
    {
        return $this->hash;
    }

    /**
     * @return \DateTIme
     */
    public function date(): \DateTIme
    {
        return clone $this->date;
    }

    /**
     * @return string
     */
    public function subject(): string
    {
        return $this->subject;
    }

    public function __toString()
    {
        return $this->hash;
    }
}
