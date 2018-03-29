<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\LogType\LogTypeInterface;

/**
 * Interface TypeToRegularExpressionConverterInterface
 * @package Varnish\Log\Parser
 */
interface TypeToRegularExpressionConverterInterface
{
    /**
     * @param LogTypeInterface $type
     * @return string
     */
    public function convertTypeToRegularExpression(LogTypeInterface $type) : string;
}
