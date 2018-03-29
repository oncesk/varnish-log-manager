<?php

namespace Varnish\Log;

/**
 * Interface CollectionInterface
 * @package Varnish\Log
 */
interface CollectionInterface extends \Countable
{
    /**
     * @param LogInterface $log
     * @return CollectionInterface
     */
    public function addLog(LogInterface $log) : CollectionInterface;

    /**
     * @return LogInterface[]
     */
    public function getAll() : array;
}
