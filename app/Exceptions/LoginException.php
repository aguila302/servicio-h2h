<?php

namespace App\Exceptions;

use Exception;

class LoginException extends Exception
{

    private $errors;

    public function __construct(
        $message,
        $errors = [],
        $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
