<?php

namespace Varnish\Log\Transformer;

use Varnish\Log\LogInterface;
use Varnish\Log\Parser\LogEntryInterface;

/**
 * Interface LogEntryToLogInterface
 * @package Varnish\Log\Transformer
 */
interface LogEntryToLogInterface
{
	/**
	 * @param LogEntryInterface $logEntry
	 * @throws TransformationFailedException
	 * @return LogInterface
	 */
    public function transform(LogEntryInterface $logEntry) : LogInterface;
}
