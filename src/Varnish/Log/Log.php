<?php

namespace Varnish\Log;

/**
 * Class Log
 * @package Varnish\Log
 */
class Log implements LogInterface
{
	/**
	 * @var int
	 */
	private $id;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var string[]
     */
    private $varnishInfo;

    /**
     * Log constructor.
     * @param int $id
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $varnishInfo
     */
    public function __construct(int $id, RequestInterface $request, ResponseInterface $response, array $varnishInfo = [])
    {
    	$this->id = $id;
        $this->request = $request;
        $this->response = $response;
        $this->varnishInfo = $varnishInfo;
    }

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
     * @inheritdoc
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @inheritdoc
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @inheritdoc
     */
    public function getVarnishInfo(): array
    {
        return $this->varnishInfo;
    }
}
