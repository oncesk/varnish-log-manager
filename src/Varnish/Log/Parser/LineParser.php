<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\Exception\LineNotMatchedException;
use Varnish\Log\Parser\LogType\LogTypeInterface;
use Varnish\Log\Parser\LogType\Provider;

/**
 * Class LineParser
 * @package Varnish\Log\Parser
 */
class LineParser implements LineParserInterface
{
    /**
     * @param string $line
     * @param ContextInterface $context
     *
     * @throws LineNotMatchedException
     *
     * @return LineParseResultInterface
     */
    public function parseLine(string $line, ContextInterface $context): LineParseResultInterface
    {
        $line = trim($line);
        $types = $context->getLogTypeProvider()->getTypes();
        $typeConverter = $context->getTypeToRegularExpressionConverter();
        $typeFactory = $context->getLogTypeFactory();

        foreach ($types as $code => $stringType) {
            $type = $typeFactory->createLogType($code, $stringType);
            $regularExpression = $typeConverter->convertTypeToRegularExpression($type);

            list($result, $matches) = $this->parseLineWithRegularExpression($line, $regularExpression);

            $parseResult = $this->process($result, $matches, $type, $context);

            if ($parseResult) {
                return $parseResult;
            }
        }

        $this->throwNotMatchedException($line);
    }

    /**
     * @param bool $result
     * @param array $matches
     * @param LogTypeInterface $type
     * @param ContextInterface $context
     * @return LineParseResultInterface|null
     */
    protected function process(bool $result, array $matches, LogTypeInterface $type, ContextInterface $context)
    {
        if ($result) {

            if (in_array($type->getCode(), [Provider::TYPE_BEGIN, Provider::TYPE_BEGIN_DETAILS, Provider::TYPE_BEREG_BEGIN])) {
                return $context->getLineParseResultFactory()->createLineParseResult($type, $matches[2]);
            }

            if ($type->getCode() === Provider::TYPE_END) {
                return $context->getLineParseResultFactory()->createLineParseResult($type, "End");
            }

        }

        if (!empty($matches)) {
            return $context->getLineParseResultFactory()->createLineParseResult($type, $matches[1]);
        }

        return null;
    }

    /**
     * @param string $line
     * @param string $regularExpression
     * @return array
     */
    protected function parseLineWithRegularExpression(string $line, string $regularExpression) : array
    {
        $result = preg_match($regularExpression, $line, $matches);

        return [$result, $matches];
    }

    /**
     * @param string $line
     * @throws LineNotMatchedException
     */
    protected function throwNotMatchedException(string $line)
    {
        throw new LineNotMatchedException(sprintf(
            "Could not parse line, has no matches: [%s]",
            $line
        ));
    }
}
