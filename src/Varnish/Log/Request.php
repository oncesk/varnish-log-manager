<?php

namespace Varnish\Log;

use Varnish\Log\Traits\HeadersAwareTrait;

/**
 * Class Request
 * @package Varnish\Log
 */
class Request implements RequestInterface
{
    use HeadersAwareTrait;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $url;

	/**
	 * Request constructor.
	 * @param string $method
	 * @param string $url
	 */
    public function __construct(string $method, string $url)
    {
        $this->method = $method;
        $this->url = $url;
    }

    /**
     * @inheritdoc
     */
    public function getMethod(): string
    {
        return strtolower($this->method);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
