<?php

namespace Varnish\Log\Parser\LogType;

/**
 * Class LogTypes
 * @package Varnish\Log\Parser\LogType
 */
class Provider implements ProviderInterface
{
    /**
     * @inheritdoc
     */
    public function getTypes()
    {
        return [
            static::TYPE_BEGIN => 'Request',
            static::TYPE_BEGIN_DETAILS => 'Begin',
            static::TYPE_REQ_METHOD => 'ReqMethod',
            static::TYPE_REQ_URL => 'ReqURL',
            static::TYPE_REQ_PROTO => 'ReqProtocol',
            static::TYPE_REQ_HEADER => 'ReqHeader',
            static::TYPE_REQ_HEADER_UNSET => 'ReqUnset',
            static::TYPE_RES_PROTO => 'RespProtocol',
            static::TYPE_RES_STATUS => 'RespStatus',
            static::TYPE_RES_REASON => 'RespReason',
            static::TYPE_RES_HEADER => 'RespHeader',
            static::TYPE_END => 'End',

            static::TYPE_BEREG_BEGIN => 'BeReq',
            static::TYPE_BEREG_BACKEND => 'Backend'
        ];
    }
}
