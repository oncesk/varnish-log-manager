<?php

namespace Varnish\Log;

/**
 * Class Collection
 * @package Varnish\Log
 */
class Collection implements CollectionInterface
{
    /**
     * @var LogInterface[]
     */
    protected $logs = [];

    /**
     * @param LogInterface $log
     * @return CollectionInterface
     */
    public function addLog(LogInterface $log): CollectionInterface
    {
        $this->logs[] = $log;
        return $this;
    }

    /**
     * @return LogInterface[]
     */
    public function getAll(): array
    {
        return $this->logs;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->logs);
    }

	/**
	 * @inheritdoc
	 */
	public function clear()
	{
		$this->logs = [];
	}

	public function __clone()
	{
		$this->clear();
	}
}
