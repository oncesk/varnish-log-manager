<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\LogType\LogTypeInterface;

/**
 * Interface LineParseResultFactoryInterface
 * @package Varnish\Log\Parser
 */
interface LineParseResultFactoryInterface
{
    /**
     * @param LogTypeInterface $type
     * @param string|int $value
     * @return LineParseResultInterface
     */
    public function createLineParseResult(LogTypeInterface $type, $value) : LineParseResultInterface;
}
