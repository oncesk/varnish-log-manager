<?php

namespace Varnish\Log;

use Varnish\Log\Headers\HeadersAwareInterface;
use Varnish\Log\Headers\HeadersInterface;

/**
 * Interface ResponseInterface
 * @package Varnish\Log
 */
interface ResponseInterface extends HeadersAwareInterface
{
    /**
     * @return int
     */
    public function getStatusCode() : int;

    /**
     * @return string
     */
    public function getReason() : string;

    /**
     * @return HeadersInterface
     */
    public function getUnsetHeaders() : HeadersInterface;
}
