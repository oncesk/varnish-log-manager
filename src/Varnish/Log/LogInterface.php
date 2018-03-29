<?php

namespace Varnish\Log;

/**
 * Interface LogInterface
 * @package Varnish\Log
 */
interface LogInterface
{
    /**
     * @return RequestInterface
     */
    public function getRequest() : RequestInterface;

    /**
     * @return ResponseInterface
     */
    public function getResponse() : ResponseInterface;

    /**
     * @return string[]
     */
    public function getVarnishInfo() : array;
}
