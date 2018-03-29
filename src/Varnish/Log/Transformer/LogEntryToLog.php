<?php

namespace Varnish\Log\Transformer;

use Varnish\Log\Headers\Headers;
use Varnish\Log\Log;
use Varnish\Log\LogInterface;
use Varnish\Log\Parser\LogEntryInterface;
use Varnish\Log\Parser\LogType\ProviderInterface;
use Varnish\Log\Request;
use Varnish\Log\Response;
use Varnish\Log\ExtractorInterface as ExtractorInterface;

/**
 * Class LogEntryToLog
 * @package Varnish\Log\Transformer
 */
class LogEntryToLog implements LogEntryToLogInterface
{
	/**
	 * @var ExtractorInterface
	 */
	protected $extractor;

	/**
	 * LogEntryToLog constructor.
	 * @param ExtractorInterface $extractor
	 */
	public function __construct(ExtractorInterface $extractor)
	{
		$this->extractor = $extractor;
	}

	/**
	 * @param LogEntryInterface $logEntry
	 * @return LogInterface
	 */
	public function transform(LogEntryInterface $logEntry): LogInterface
	{
		$requestHeaders = $this->extractor->extract($logEntry, ProviderInterface::TYPE_REQ_HEADER);
		$responseHeaders = $this->extractor->extract($logEntry, ProviderInterface::TYPE_RES_HEADER);


		var_dump($this->extractor->extract($logEntry, ProviderInterface::TYPE_REQ_METHOD));

		if (null === $this->extractor->extract($logEntry, ProviderInterface::TYPE_REQ_METHOD)) {
			print_r($logEntry);
		}

		$request = $this->createRequest(
			$this->extractor->extract($logEntry, ProviderInterface::TYPE_REQ_METHOD),
			$this->extractor->extract($logEntry, ProviderInterface::TYPE_REQ_URL)
		);
		$request->getHeaders()->replace($requestHeaders);

		$response = $this->createResponse(
			$this->extractor->extract($logEntry, ProviderInterface::TYPE_RES_STATUS),
			$this->extractor->extract($logEntry, ProviderInterface::TYPE_RES_REASON),
			$responseHeaders
		);

		$log = new Log(
			$request,
			$response
		);

		return $log;
	}

	/**
	 * @param string $method
	 * @param string $url
	 * @return Request
	 */
	protected function createRequest(string $method, string $url)
	{
		return new Request($method, $url);
	}

	/**
	 * @param $statusCode
	 * @param string $reason
	 * @return Response
	 */
	protected function createResponse($statusCode, string $reason, array $headers)
	{
		return new Response($statusCode, $reason, new Headers($headers));
	}
}
