<?php

namespace devphp\Exception;

class ControllerNotFoundException extends \Exception
{
    public function __construct()
    {
        $message = 'No controller found for specified route';
        $code = 404;
        parent::__construct($message, $code);
    }
}