<?php
namespace F3\Changelog\Git;

class Commit
{
    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * @var string
     */
    private $subject;

    public function __construct(\DateTimeInterface $date, string $subject)
    {
        $this->date = $date;
        $this->subject = $subject;
    }


    public static function fromLogEntry(array $log_entry): self
    {
        return new self(
            \DateTimeImmutable::createFromFormat(DATE_ISO8601, $log_entry['date']),
            $log_entry['subject']
        );
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }
}
