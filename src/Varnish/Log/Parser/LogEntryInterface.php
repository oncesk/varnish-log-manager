<?php

namespace Varnish\Log\Parser;

/**
 * Interface LogEntryInterface
 * @package Varnish\Log\Parser
 */
interface LogEntryInterface
{
    /**
     * @return int
     */
    public function getId() : int;

    /**
     * @param LineParseResultInterface $result
     * @return LogEntryInterface
     */
    public function addResult(LineParseResultInterface $result) : LogEntryInterface;

    /**
     * @return LineParseResultInterface[]
     */
    public function getResults() : array;

    /**
     * @param LogEntryInterface $logEntry
     * @return LogEntryInterface
     */
    public function setChildLogEntry(LogEntryInterface $logEntry) : LogEntryInterface;

    /**
     * @return LogEntryInterface
     */
    public function getChildLogEntry() : LogEntryInterface;
}
