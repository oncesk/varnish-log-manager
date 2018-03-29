<?php

namespace Varnish\Log\Parser\LogType;

/**
 * Interface TypeInterface
 * @package Varnish\Log\Parser\LogType
 */
interface ProviderInterface
{
    const TYPE_BEGIN = 0;
    const TYPE_BEGIN_DETAILS = 98;
    const TYPE_REQ_METHOD = 1;
    const TYPE_REQ_URL = 2;
    const TYPE_REQ_PROTO = 3;
    const TYPE_REQ_HEADER = 4;
    const TYPE_REQ_HEADER_UNSET = 5;
    const TYPE_RES_PROTO = 6;
    const TYPE_RES_STATUS = 7;
    const TYPE_RES_REASON = 8;
    const TYPE_RES_HEADER = 9;
    const TYPE_END = 100;

    const TYPE_BEREG_BEGIN = 20;
    const TYPE_BEREG_TIMESTAMP = 21;
    const TYPE_BEREG_BACKEND = 22;

    /**
     * @return array
     */
    public function getTypes();
}
