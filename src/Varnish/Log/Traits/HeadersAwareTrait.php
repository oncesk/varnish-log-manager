<?php

namespace Varnish\Log\Traits;

use Varnish\Log\Headers\Headers;
use Varnish\Log\Headers\HeadersInterface;

/**
 * Class HeadersAwareTrait
 * @package Varnish\Log\Traits
 */
trait HeadersAwareTrait
{
    /**
     * @var HeadersInterface
     */
    private $headers;

    /**
     * @return HeadersInterface
     */
    public function getHeaders() : HeadersInterface
    {
        if (null === $this->headers) {
            $this->headers = new Headers();
        }

        return $this->headers;
    }

    /**
     * @param HeadersInterface $headers
     * @return $this
     */
    public function setHeaders(HeadersInterface $headers)
    {
        $this->headers = $headers;

        return $this;
    }
}
