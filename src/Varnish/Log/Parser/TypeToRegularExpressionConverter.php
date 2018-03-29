<?php

namespace Varnish\Log\Parser;

use Varnish\Log\Parser\LogType\LogTypeInterface;
use Varnish\Log\Parser\LogType\ProviderInterface;

/**
 * Class TypeToRegularExpressionConverter
 * @package Varnish\Log\Parser
 */
class TypeToRegularExpressionConverter implements TypeToRegularExpressionConverterInterface
{
    /**
     * @param LogTypeInterface $type
     * @return string
     */
    public function convertTypeToRegularExpression(LogTypeInterface $type): string
    {
        switch ($type->getCode()) {
            case ProviderInterface::TYPE_BEGIN:
            case ProviderInterface::TYPE_BEREG_BEGIN:
                return sprintf("/(<<\\s+%s\\s+>>\\s+([0-9]+))/", $type->getStringType());
                break;

            case ProviderInterface::TYPE_BEGIN_DETAILS:
                return sprintf("/%s\\s+([a-z]+)\\s([0-9]+)\\s([a-z]+)/", $type->getStringType());
                break;

            case ProviderInterface::TYPE_END;
                return sprintf("/%s$/", $type->getStringType());
                break;

            case ProviderInterface::TYPE_REQ_METHOD:
            case ProviderInterface::TYPE_REQ_URL:
            case ProviderInterface::TYPE_REQ_PROTO:
            case ProviderInterface::TYPE_REQ_HEADER:
            case ProviderInterface::TYPE_REQ_HEADER_UNSET:
            case ProviderInterface::TYPE_RES_PROTO:
            case ProviderInterface::TYPE_RES_STATUS:
            case ProviderInterface::TYPE_RES_REASON:
            case ProviderInterface::TYPE_RES_HEADER:
                return sprintf("/%s\\s+(.+)/", $type->getStringType());
                break;

            case ProviderInterface::TYPE_BEREG_BACKEND:
                return sprintf("/%s\\s+(.+)/", $type->getStringType());
                break;
        }

        throw new \RuntimeException(sprintf(
            "Could not convert type %s:%s to regular expression",
            $type->getCode(),
            $type->getStringType()
        ));
    }
}
