<?php

namespace Varnish\Log;

use Varnish\Log\Headers\HeadersInterface;
use Varnish\Log\Traits\HeadersAwareTrait;

/**
 * Class Response
 * @package Varnish\Log
 */
class Response implements ResponseInterface
{
    use HeadersAwareTrait;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var HeadersInterface
     */
    private $unsetHeaders;

    /**
     * Response constructor.
     * @param int $statusCode
     * @param string $reason
     * @param HeadersInterface $unsetHeaders
     */
    public function __construct($statusCode, string $reason, HeadersInterface $unsetHeaders)
    {
        $this->statusCode = (int) $statusCode;
        $this->reason = $reason;
        $this->unsetHeaders = $unsetHeaders;
    }

    /**
     * @inheritdoc
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @inheritdoc
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * @inheritdoc
     */
    public function getUnsetHeaders(): HeadersInterface
    {
        return $this->unsetHeaders;
    }

}
