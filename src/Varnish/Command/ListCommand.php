<?php

namespace Varnish\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Varnish\Log\Collection;
use Varnish\Log\CollectionInterface;
use Varnish\Log\Extractor;
use Varnish\Log\Filter\DefaultFilter;
use Varnish\Log\Parser\Context;
use Varnish\Log\Parser\LineParser;
use Varnish\Log\Parser\LineParseResultFactory;
use Varnish\Log\Parser\LogEntryCollection;
use Varnish\Log\Parser\LogType\Factory;
use Varnish\Log\Parser\LogType\Provider;
use Varnish\Log\Parser\Parser;
use Varnish\Log\Parser\TypeToRegularExpressionConverter;
use Varnish\Log\Renderer\ListRenderer;
use Varnish\Log\Transformer\LogEntryToLog;
use Varnish\Log\Transformer\TransformationFailedException;

/**
 * Class ListCommand
 * @package Varnish\Command
 */
class ListCommand extends Command
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('list')
            ->setDescription('Display logs as a table')
            ->addOption('filter', 'f', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Filter logs, you can use few filter options')
            ->addOption('count', 'c', InputOption::VALUE_NONE, 'Display only number of logs and exit')
	        ->addOption('no-trunc', null, InputOption::VALUE_NONE, 'Do not truncate results')
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

        	try {
		        $log = $transformer->transform($logEntry);
		        $logCollection->addLog($log);
	        } catch (TransformationFailedException $e) {
        		if ($input->getOption('verbose')) {
        			$output->writeln("<error>" . $e->getMessage() . "</error>");
		        }
	        }
        }

        $logCollection = $this->filter($input, $logCollection);

	    $renderer = new ListRenderer();
        $renderer->render($input, $output, $logCollection);
    }

	/**
	 * @param InputInterface $input
	 * @param CollectionInterface $collection
	 * @return CollectionInterface
	 */
    protected function filter(InputInterface $input, CollectionInterface $collection)
    {
	    $filter = new DefaultFilter(PropertyAccess::createPropertyAccessor());

	    return $filter->filter($input->getOption('filter'), $collection);
    }
}
