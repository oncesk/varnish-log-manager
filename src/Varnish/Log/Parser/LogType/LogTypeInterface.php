<?php

namespace Varnish\Log\Parser\LogType;

/**
 * Interface LogTypeInterface
 * @package Varnish\Log\Parser
 */
interface LogTypeInterface
{
    /**
     * @return int
     */
    public function getCode() : int;

    /**
     * @return string
     */
    public function getStringType() : string;
}
