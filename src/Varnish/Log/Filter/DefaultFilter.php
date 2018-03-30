<?php

namespace Varnish\Log\Filter;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Varnish\Log\CollectionInterface;
use Varnish\Log\LogInterface;

/**
 * Class DefaultFilter
 * @package Varnish\Log\Filter
 */
class DefaultFilter implements FilterInterface
{
	/**
	 * @var PropertyAccessorInterface
	 */
	protected $propertyAccessor;

	/**
	 * DefaultFilter constructor.
	 * @param PropertyAccessorInterface $propertyAccessor
	 */
	public function __construct(PropertyAccessorInterface $propertyAccessor)
	{
		$this->propertyAccessor = $propertyAccessor;
	}

	/**
	 * @param array $criteria
	 * @param CollectionInterface $collection
	 * @return CollectionInterface
	 */
	public function filter(array $criteria, CollectionInterface $collection): CollectionInterface
	{
		if (empty($criteria)) {
			return $collection;
		}

		$criteria = $this->prepareCriteria($criteria);

		$resultCollection = clone $collection;
		$resultCollection->clear();

		foreach ($collection->getAll() as $log) {
			if ($this->isLogSatisfiedByCriteria($criteria, $log)) {
				$resultCollection->addLog($log);
			}
		}

		return $resultCollection;
	}

	/**
	 * @param array $criteria
	 * @param LogInterface $log
	 *
	 * @return boolean
	 */
	protected function isLogSatisfiedByCriteria(array $criteria, LogInterface $log) : bool
	{
		foreach ($criteria as $filter) {
			list($field, $filterValue) = $filter;

			$fieldValue = strtolower($this->propertyAccessor->getValue($log, $field));

			if (false === strpos($fieldValue, strtolower($filterValue))) {
				return false;
			}
		}

		return true;
	}

	/**
	 * @param array $criteria like Id=12 Id=21 Request.RequestMethod=post Request.Url=mobiel
	 * @return array
	 */
	protected function prepareCriteria(array $criteria) : array
	{
		$criteries = [];

		foreach ($criteria as $filterString) {
			list($field, $value) = explode('=', $filterString);

			$criteries[] = [$field, $value];
		}

		return $criteries;
	}
}
