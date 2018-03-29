<?php

namespace Varnish\Log\Parser\LogType;

/**
 * Class Factory
 * @package Varnish\Log\Parser\LogType
 */
class Factory implements FactoryInterface
{
    /**
     * @var LogTypeInterface[]
     */
    protected $logTypes = [];

    /**
     * @param int $code
     * @param string $stringType
     * @return LogTypeInterface
     */
    public function createLogType(int $code, string $stringType): LogTypeInterface
    {
        if (isset($this->logTypes[$code])) {
            return $this->logTypes[$code];
        }

        return $this->logTypes[$code] = new LogType($code, $stringType);
    }
}
