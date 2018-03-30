<?php

namespace Varnish\Log\Filter;

use Varnish\Log\CollectionInterface;

/**
 * Interface FilterInterface
 * @package Varnish\Log\Filter
 */
interface FilterInterface
{
	/**
	 * @param array $criteria
	 * @param CollectionInterface $collection
	 * @return CollectionInterface
	 */
	public function filter(array $criteria, CollectionInterface $collection) : CollectionInterface;
}
