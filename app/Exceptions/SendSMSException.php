<?php

namespace App\Exceptions;

use Throwable;

class SendSMSException extends \DomainException
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
