<?php

namespace Varnish\Log\Parser;

/**
 * Class LogEntry
 * @package Varnish\Log\Parser
 */
class LogEntry implements LogEntryInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var LineParseResultInterface[]
     */
    protected $results = [];

    /**
     * @var LogEntryInterface
     */
    protected $child;

    /**
     * LogEntry constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param LineParseResultInterface $result
     * @return LogEntryInterface
     */
    public function addResult(LineParseResultInterface $result): LogEntryInterface
    {
        $this->results[] = $result;

        return $this;
    }

    /**
     * @return LineParseResultInterface[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param LogEntryInterface $logEntry
     * @return LogEntryInterface
     */
    public function setChildLogEntry(LogEntryInterface $logEntry): LogEntryInterface
    {
        $this->child = $logEntry;

        return $this;
    }

    /**
     * @return LogEntryInterface
     */
    public function getChildLogEntry(): LogEntryInterface
    {
        return $this->child;
    }
}
