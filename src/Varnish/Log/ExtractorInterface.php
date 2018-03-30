<?php

namespace Varnish\Log;

use Varnish\Log\Parser\LogEntryInterface;

/**
 * Interface ExtractorInterface
 * @package Varnish\Log\Headers\
 */
interface ExtractorInterface
{
	/**
	 * @param LogEntryInterface $logEntry
	 * @param int $typeCode
	 * @return string[][]|string|null
	 */
	public function extract(LogEntryInterface $logEntry, int $typeCode);
}
