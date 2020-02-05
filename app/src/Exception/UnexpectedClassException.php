<?php


namespace ProjetWeb\Exception;

class UnexpectedClassException extends \UnexpectedValueException
{
    public function __construct($expected, $real)
    {
        $message = "I was hoping for an " . $expected . "But I got " . $real . " instead";
        parent::__construct($message);
    }
}