<?php

namespace Varnish\Log\Parser;

/**
 * Class LogEntryCollection
 * @package Varnish\Log\Parser
 */
class LogEntryCollection implements LogEntryCollectionInterface
{
    /**
     * @var LogEntryInterface[]
     */
    protected $entries = [];

    /**
     * @param int $id
     * @return bool
     */
    public function has(int $id): bool
    {
        return isset($this->entries[$id]);
    }

    /**
     * @param LogEntryInterface $logEntry
     * @return LogEntryCollectionInterface
     */
    public function add(LogEntryInterface $logEntry): LogEntryCollectionInterface
    {
        $this->entries[$logEntry->getId()] = $logEntry;

        return $this;
    }

    /**
     * @param int $id
     * @return LogEntryInterface
     */
    public function get(int $id): LogEntryInterface
    {
        if ($this->has($id)) {
            return $this->entries[$id];
        }

        throw new \RuntimeException('Entry with id ' . $id . ' not found');
    }

    /**
     * @param int $id
     */
    public function remove(int $id)
    {
        if ($this->has($id)) {
            unset($this->entries[$id]);
        }
    }

	/**
	 * @return LogEntryInterface[]
	 */
	public function getAll(): array
	{
		return $this->entries;
	}
}
