<?php

namespace devphp\Exception;

class ActionNotFoundException extends \Exception
{
    public function __construct()
    {
        $message = 'No action found for specified route';
        parent::__construct($message);
    }
}