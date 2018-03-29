<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\LogType\LogTypeInterface;

/**
 * Class LineParseResultFactory
 * @package Varnish\Log\Parser
 */
class LineParseResultFactory implements LineParseResultFactoryInterface
{
    /**
     * @param LogTypeInterface $type
     * @param int|string $value
     * @return LineParseResultInterface
     */
    public function createLineParseResult(LogTypeInterface $type, $value): LineParseResultInterface
    {
        return new LineParseResult($type, $value);
    }
}
