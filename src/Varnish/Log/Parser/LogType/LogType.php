<?php

namespace Varnish\Log\Parser\LogType;

/**
 * Class LogType
 * @package Varnish\Log\Parser\LogType
 */
class LogType implements LogTypeInterface
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $type;

    /**
     * LogType constructor.
     * @param int $code
     * @param string $type
     */
    public function __construct(int $code, string $type)
    {
        $this->code = $code;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getStringType(): string
    {
        return $this->type;
    }
}
