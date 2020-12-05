<?php


namespace IvaoSocialite\Exception;


use ErrorException;

class DomainNotAllowedException extends ErrorException
{
    protected $message = 'This domain is not allowed to use the Login API! Contact the System Administrator';
}