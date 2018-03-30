<?php

namespace Varnish\Log\Renderer;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Varnish\Log\CollectionInterface;

/**
 * Class ListRenderer
 * @package Varnish\Log\Renderer
 */
class ListRenderer implements RendererInterface
{
	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @param CollectionInterface $collection
	 */
	public function render(InputInterface $input, OutputInterface $output, CollectionInterface $collection)
	{
		$table = new Table($output);

		$table->setHeaders([
			'Id',
			'Req Method',
			'Url',
			'Response Code',
			'Response Reason'
		]);

		$methods = [
			'get' => 0,
			'post' => 0,
			'put' => 0
		];

		foreach ($collection->getAll() as $log) {

			$requestMethod = $log->getRequest()->getMethod();

			if (isset($methods[$requestMethod])) {
				$methods[$requestMethod]++;
			}

			$table->addRow([
				$log->getId(),
				$requestMethod,
				$this->format($log->getRequest()->getUrl(), $input),
				$log->getResponse()->getStatusCode(),
				$log->getResponse()->getReason()
			]);
		}

		$table->addRow(new TableSeparator());

		$table->addRow([
			new TableCell(
				sprintf(
					"Total: %s, Get: %s, Post: %s, Put: %s",
					$collection->count(),
					$methods['get'],
					$methods['post'],
					$methods['put']
				),
				[
					'colspan' => 5
				]
			)
		]);

		$table->render();
	}

	/**
	 * @param string $string
	 * @param InputInterface $input
	 *
	 * @return string
	 */
	protected function format(string $string, InputInterface $input) : string
	{
		if ($input->getOption('no-trunc')) {
			return $string;
		}

		return substr($string, 0, 32) . ' ...';
	}
}
