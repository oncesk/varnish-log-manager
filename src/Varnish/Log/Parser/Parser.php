<?php

namespace Varnish\Log\Parser;

use Varnish\Log\CollectionInterface;
use Varnish\Log\Headers;
use Varnish\Log\Log;
use Varnish\Log\Parser\Exception\LineNotMatchedException;
use Varnish\Log\Parser\LogType\Provider;
use Varnish\Log\Parser\LogType\ProviderInterface;
use Varnish\Log\Request;
use Varnish\Log\Response;

/**
 * Class Parser
 * @package Varnish\Log\Parser
 */
class Parser implements ParserInterface
{
    /**
     * @var LineParserInterface
     */
    protected $lineParser;

    /**
     * Parser constructor.
     * @param LineParserInterface $lineParser
     */
    public function __construct(LineParserInterface $lineParser)
    {
        $this->lineParser = $lineParser;
    }

    /**
     * @param string $logs
     * @param ContextInterface $context
     * @param LogEntryCollectionInterface $logEntryCollection
     * @return LogEntryCollection|LogEntryCollectionInterface
     */
    public function parse(string $logs, ContextInterface $context, LogEntryCollectionInterface $logEntryCollection)
    {
        $logs = $this->splitLogContentToLogLines($logs);
        $logEntry = null;

        foreach ($logs as $line) {
            try {
                $lineParseResult = $this->lineParser->parseLine($line, $context);
            } catch (LineNotMatchedException $exception) {
                continue;
            }

            if (in_array($lineParseResult->getLogType()->getCode(), [ProviderInterface::TYPE_BEGIN, ProviderInterface::TYPE_BEREG_BEGIN])) {
                $logEntry = new LogEntry((int) $lineParseResult->getValue());
                $logEntryCollection->add($logEntry);
                continue;
            }

            if ($lineParseResult->getLogType()->getCode() === ProviderInterface::TYPE_BEGIN_DETAILS) {
                $id = (int) $lineParseResult->getValue();

                if ($logEntryCollection->has($id)) {
                    $logEntryCollection->get($id)->setChildLogEntry($logEntry);
                    $logEntryCollection->remove($logEntry->getId());
                }
            }

            $logEntry->addResult($lineParseResult);
        }
    }

    /**
     * @param int $code
     * @param LineParseResultInterface[] $entries
     *
     * @return LineParseResultInterface
     */
    protected function extractFromLogEntries(int $code, array $entries)
    {
        foreach ($entries as $entry) {
            if ($entry->getLogType()->getCode() == $code) {
                return $entry;
            }
        }

        return null;
    }

    /**
     * @param string $logs
     * @return array
     */
    protected function splitLogContentToLogLines(string $logs) : array
    {
        return explode("\n", $logs);
    }
}
