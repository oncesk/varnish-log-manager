<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\LogType\LogTypeInterface;

/**
 * Class LineParseResult
 * @package Varnish\Log\Parser
 */
class LineParseResult implements LineParseResultInterface
{
    /**
     * @var LogTypeInterface
     */
    private $type;

    /**
     * @var string
     */
    private $value;

    /**
     * LineParseResult constructor.
     * @param LogTypeInterface $type
     * @param string|array $value
     */
    public function __construct(LogTypeInterface $type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return LogTypeInterface
     */
    public function getLogType(): LogTypeInterface
    {
        return $this->type;
    }

    /**
     * @return string|array
     */
    public function getValue()
    {
        return $this->value;
    }
}
