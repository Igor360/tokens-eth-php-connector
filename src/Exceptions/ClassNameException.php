<?php declare(strict_types=1);

namespace Igor360\NftEthPhpConnector\Exceptions;

final class ClassNameException extends \Exception
{
    protected $message = ERROR_MESSAGES::INVALID_CLASS_NAME;
}