<?php

namespace Freemius\Exceptions;

/**
 * Freemius_OAuthException
 *
 * @package Freemius
 * @subpackage Exceptions
 */

class Freemius_OAuthException extends Freemius_Exception
{
    public function __construct($pResult)
    {
        parent::__construct($pResult);
    }
}
