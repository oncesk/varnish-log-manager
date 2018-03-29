<?php

namespace Varnish\Log\Parser\LogType;

/**
 * Interface LogTypeFactoryInterface
 * @package Varnish\Log\Parser
 */
interface FactoryInterface
{
    /**
     * @param int $code
     * @param string $stringType
     * @return LogTypeInterface
     */
    public function createLogType(int $code, string $stringType) : LogTypeInterface;
}
