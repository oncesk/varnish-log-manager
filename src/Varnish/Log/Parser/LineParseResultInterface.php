<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\LogType\LogTypeInterface;

/**
 * Interface LineParseResultInterface
 * @package Varnish\Log\Parser
 */
interface LineParseResultInterface
{
    /**
     * @return LogTypeInterface
     */
    public function getLogType() : LogTypeInterface;

    /**
     * @return string|array
     */
    public function getValue();
}
