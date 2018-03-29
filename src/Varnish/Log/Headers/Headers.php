<?php

namespace Varnish\Log\Headers;

/**
 * Class Headers
 * @package Varnish\Log
 */
class Headers implements HeadersInterface
{
    /**
     * @var string[][]
     */
    private $headers;

    /**
     * Headers constructor.
     * @param array $headers
     */
    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
    }

    /**
     * @return string[][]
     */
    public function getAll(): array
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed|null|\string[]
     */
    public function get(string $name, $default = null)
    {
        if ($this->has($name)) {
            return $this->headers[$name];
        }

        return $default;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->headers[$name]);
    }

	/**
	 * @param array $headers
	 */
	public function replace(array $headers = [])
	{
		$this->headers = $headers;
	}
}
