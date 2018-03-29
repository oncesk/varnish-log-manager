<?php

namespace Varnish\Log\Headers;

/**
 * Interface HeadersInterface
 * @package Varnish\Log\Headers
 */
interface HeadersInterface
{
    /**
     * Get associative array with headers
     *
     * @return string[]
     */
    public function getAll() : array;

    /**
     * @param string $name
     * @param mixed $default
     * @return string|string[]
     */
    public function get(string $name, $default = null);

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name) : bool;

	/**
	 * @param array $headers
	 */
    public function replace(array $headers = []);
}
