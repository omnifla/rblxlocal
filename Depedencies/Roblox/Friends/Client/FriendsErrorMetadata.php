<?php

// written by omnifla

namespace Roblox\Friends\Client;

class FriendsErrorMetadata
{
    protected int|string $errorType;
    protected string $errorMessage;

    public function __construct(
        int|string $errorType,
        string $errorMessage
    ) {
        $this->errorType = $errorType;
        $this->errorMessage = $errorMessage;
    }

    public function getErrorType(): int|string
    {
        return $this->errorType;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}