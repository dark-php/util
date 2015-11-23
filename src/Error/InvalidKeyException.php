<?php

namespace Darktec\Error;

/**
 * Throws an exception when an invalid key is given for an array
 *
 * @package Framework\Util
 */
class InvalidKeyException extends \Exception
{
    public function __construct($message = "Invalid Index") {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message);
    }

    /**
     * Returns error message as a string
     *
     * @return string Error message
     */
    public function __toString(): string
    {
        return __CLASS__ . ": {$this->message}\n";
    }
}