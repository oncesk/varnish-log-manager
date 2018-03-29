<?php

namespace Varnish\Log;

use Varnish\Log\Headers\HeadersAwareInterface;

/**
 * Interface RequestInterface
 * @package Varnish\Log
 */
interface RequestInterface extends HeadersAwareInterface
{
    /**
     * Returns request method in lowercase
     *
     * @return string
     */
    public function getMethod() : string;

    /**
     * @return string
     */
    public function getUrl() : string;
}
