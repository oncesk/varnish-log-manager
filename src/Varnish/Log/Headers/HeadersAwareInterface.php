<?php

namespace Varnish\Log\Headers;

/**
 * Interface HeadersAwareInterface
 * @package Varnish\Log\Headers
 */
interface HeadersAwareInterface
{
    /**
     * @return HeadersInterface
     */
    public function getHeaders() : HeadersInterface;

    /**
     * @param HeadersInterface $headers
     * @return $this
     */
    public function setHeaders(HeadersInterface $headers);
}
