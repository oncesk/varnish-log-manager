<?php

namespace Varnish\Log;

use Varnish\Log\Parser\LineParseResultInterface;
use Varnish\Log\Parser\LogEntryInterface;
use Varnish\Log\Parser\LogType\ProviderInterface;

/**
 * Class Extractor
 * @package Varnish\Log\Headers
 */
class Extractor implements ExtractorInterface
{
	/**
	 * @param LogEntryInterface $logEntry
	 * @param int $typeCode
	 * @return array|string[][]|string|null
	 */
	public function extract(LogEntryInterface $logEntry, int $typeCode)
	{
		$response = $this->isHeaderResult($typeCode) ? [] : null;

		foreach ($logEntry->getResults() as $result) {

			if ($result->getLogType()->getCode() === $typeCode) {

				if ($this->isHeaderResult($typeCode)) {
					list($name, $value) = $this->parseHeader($result->getValue());

					if (isset($response[$name])) {

						if ($response[$name] == $value) {
							continue;
						}

						if (!is_array($response[$name])) {
							$response[$name] = (array) $response[$name];
						}

						if (!in_array($value, $response[$name])) {
							$response[$name][] = $value;
						}

					} else {
						$response[$name] = $value;
					}
				} else {
					return $result->getValue();
				}
			}
		}

		return $response;
	}

	/**
	 * @param string $header
	 * @return array
	 */
	protected function parseHeader(string $header) : array
	{
		$chunks = @explode(':', $header, 2);

		return [
			$chunks[0],
			trim($chunks[1])
		];
	}

	/**
	 * @param int $code
	 * @return bool
	 */
	protected function isHeaderResult(int $code) : bool
	{
		return in_array(
			$code,
			[
				ProviderInterface::TYPE_REQ_HEADER,
				ProviderInterface::TYPE_RES_HEADER,
				ProviderInterface::TYPE_REQ_HEADER_UNSET
			]
		);
	}
}
