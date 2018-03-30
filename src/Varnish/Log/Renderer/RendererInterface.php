<?php

namespace Varnish\Log\Renderer;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Varnish\Log\CollectionInterface;

/**
 * Class RendererInterface
 * @package Varnish\Log\Renderer
 */
interface RendererInterface
{
	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @param CollectionInterface $collection
	 */
	public function render(InputInterface $input, OutputInterface $output, CollectionInterface $collection);
}
