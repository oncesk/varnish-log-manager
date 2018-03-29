<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\LogType\FactoryInterface;
use Varnish\Log\Parser\LogType\ProviderInterface;

/**
 * Class Context
 * @package Varnish\Log\Parser
 */
class Context implements ContextInterface
{
    /**
     * @var ProviderInterface
     */
    private $logTypeProvider;

    /**
     * @var FactoryInterface
     */
    private $logTypeFactory;

    /**
     * @var LineParseResultFactoryInterface
     */
    private $lineParseResultFactory;

    /**
     * @var TypeToRegularExpressionConverterInterface
     */
    private $typeToRegularExpressionConverter;

    /**
     * Context constructor.
     * @param ProviderInterface $logTypeProvider
     * @param FactoryInterface $logTypeFactory
     * @param LineParseResultFactoryInterface $lineParseResultFactory
     * @param TypeToRegularExpressionConverterInterface $typeToRegularExpressionConverter
     */
    public function __construct(ProviderInterface $logTypeProvider, FactoryInterface $logTypeFactory, LineParseResultFactoryInterface $lineParseResultFactory, TypeToRegularExpressionConverterInterface $typeToRegularExpressionConverter)
    {
        $this->logTypeProvider = $logTypeProvider;
        $this->logTypeFactory = $logTypeFactory;
        $this->lineParseResultFactory = $lineParseResultFactory;
        $this->typeToRegularExpressionConverter = $typeToRegularExpressionConverter;
    }

    /**
     * @return ProviderInterface
     */
    public function getLogTypeProvider(): ProviderInterface
    {
        return $this->logTypeProvider;
    }

    /**
     * @return FactoryInterface
     */
    public function getLogTypeFactory(): FactoryInterface
    {
        return $this->logTypeFactory;
    }

    /**
     * @return LineParseResultFactoryInterface
     */
    public function getLineParseResultFactory(): LineParseResultFactoryInterface
    {
        return $this->lineParseResultFactory;
    }

    /**
     * @return TypeToRegularExpressionConverterInterface
     */
    public function getTypeToRegularExpressionConverter(): TypeToRegularExpressionConverterInterface
    {
        return $this->typeToRegularExpressionConverter;
    }
}
