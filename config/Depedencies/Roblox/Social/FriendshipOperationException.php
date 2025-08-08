<?php

namespace Roblox\Social;

use Roblox\Friends\Client\FriendsErrorMetadata;
use Roblox\Platform\Core\PlatformException;

class FriendshipOperationException extends PlatformException
{
    /** @var FriendshipOperationErrorType */
    private FriendshipOperationErrorType $errorType;

    public function __construct(FriendsErrorMetadata|FriendshipOperationErrorType $error, string $errorMessage = '')
    {
        if ($error instanceof FriendsErrorMetadata) {
            parent::__construct($error->getErrorMessage());
            $this->errorType = FriendshipOperationErrorType::from($error->getErrorType());
        } else {
            parent::__construct($errorMessage);
            $this->errorType = $error;
        }
    }

    public function getErrorType(): FriendshipOperationErrorType
    {
        return $this->errorType;
    }

    public function shouldSkipLogging(): bool
    {
        return true;
    }
}
