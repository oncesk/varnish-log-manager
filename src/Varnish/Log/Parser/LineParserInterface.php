<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\Exception\LineNotMatchedException;

/**
 * Interface LineParserInterface
 * @package Varnish\Log\Parser
 */
interface LineParserInterface
{
    /**
     * @param string $line
     * @param ContextInterface $context
     * @return LineParseResultInterface
     *
     * @throws LineNotMatchedException
     */
    public function parseLine(string $line, ContextInterface $context) : LineParseResultInterface;
}
