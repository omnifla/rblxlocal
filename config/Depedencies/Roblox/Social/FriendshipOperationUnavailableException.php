<?php

namespace Roblox\Social;

use Exception;

class FriendshipOperationUnavailableException extends Exception
{
    public function __construct(string $errorMessage, Exception $innerException)
    {
        parent::__construct($errorMessage, 0, $innerException);
    }
}
