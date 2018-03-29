<?php

namespace Varnish\Log\Parser;

/**
 * Interface ParserInterface
 * @package Varnish\Log\Parser
 */
interface ParserInterface
{
    /**
     * @param string $logs
     * @param ContextInterface $context
     * @param LogEntryCollectionInterface $logEntryCollection
     */
    public function parse(string $logs, ContextInterface $context, LogEntryCollectionInterface $logEntryCollection);
}
