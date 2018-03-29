<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\LogType\FactoryInterface;
use Varnish\Log\Parser\LogType\ProviderInterface;

/**
 * Class ContextInterface
 * @package Varnish\Log\Parser
 */
interface ContextInterface
{
    /**
     * @return ProviderInterface
     */
    public function getLogTypeProvider() : ProviderInterface;

    /**
     * @return FactoryInterface
     */
    public function getLogTypeFactory() : FactoryInterface;

    /**
     * @return LineParseResultFactoryInterface
     */
    public function getLineParseResultFactory() : LineParseResultFactoryInterface;

    /**
     * @return TypeToRegularExpressionConverterInterface
     */
    public function getTypeToRegularExpressionConverter() : TypeToRegularExpressionConverterInterface;
}
