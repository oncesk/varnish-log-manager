<?php

namespace Varnish\Log\Parser;

/**
 * Interface LogEntryCollectionInterface
 * @package Varnish\Log\Parser
 */
interface LogEntryCollectionInterface
{
    /**
     * @param int $id
     * @return bool
     */
    public function has(int $id) : bool;

    /**
     * @param LogEntryInterface $logEntry
     * @return LogEntryCollectionInterface
     */
    public function add(LogEntryInterface $logEntry) : LogEntryCollectionInterface;

    /**
     * @param int $id
     * @throws \RuntimeException
     * @return LogEntryInterface
     */
    public function get(int $id) : LogEntryInterface;

    /**
     * @param int $id
     */
    public function remove(int $id);

	/**
	 * @return LogEntryInterface[]
	 */
    public function getAll() : array;
}
