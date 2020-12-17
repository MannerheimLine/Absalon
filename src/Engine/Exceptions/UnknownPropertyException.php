<?php

declare(strict_types=1);

namespace Absalon\Engine\Exceptions;

use Throwable;

class UnknownPropertyException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}