<?php

namespace Varnish\Log;

/**
 * Class Log
 * @package Varnish\Log
 */
class Log implements LogInterface
{
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
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param array $varnishInfo
     */
    public function __construct(RequestInterface $request, ResponseInterface $response, array $varnishInfo = [])
    {
        $this->request = $request;
        $this->response = $response;
        $this->varnishInfo = $varnishInfo;
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
