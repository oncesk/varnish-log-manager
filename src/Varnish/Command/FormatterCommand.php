<?php

namespace Varnish\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Varnish\Log\Collection;
use Varnish\Log\Extractor;
use Varnish\Log\Parser\Context;
use Varnish\Log\Parser\LineParser;
use Varnish\Log\Parser\LineParseResultFactory;
use Varnish\Log\Parser\LogEntryCollection;
use Varnish\Log\Parser\LogType\Factory;
use Varnish\Log\Parser\LogType\Provider;
use Varnish\Log\Parser\Parser;
use Varnish\Log\Parser\TypeToRegularExpressionConverter;
use Varnish\Log\Transformer\LogEntryToLog;

/**
 * Class FormatterCommand
 * @package Varnish\Command
 */
class FormatterCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('format')
            ->setDescription('Format logs')
            ->addOption('filter', 'f', InputArgument::OPTIONAL, 'Filter logs, you can use few filter options')
            ->addOption('count', 'c', InputArgument::OPTIONAL, 'Display only number of logs and exit', false)
            ->addArgument('source', InputArgument::REQUIRED, 'Source log file')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $context = new Context(
            new Provider(),
            new Factory(),
            new LineParseResultFactory(),
            new TypeToRegularExpressionConverter()
        );
        $lineParser = new LineParser();

        $logCollection = new Collection();
        $logEntryCollection = new LogEntryCollection();
        $parser = new Parser($lineParser);

        $content = file_get_contents($input->getArgument('source'));

        $parser->parse($content, $context, $logEntryCollection);

        $transformer = new LogEntryToLog(new Extractor());

        foreach ($logEntryCollection->getAll() as $logEntry) {
        	$logCollection->addLog($transformer->transform($logEntry));
        }
    }
}
