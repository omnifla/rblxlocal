<?php
// written by omnifla

namespace Roblox\Friends\Client;

class FriendsClientException extends \Exception
{
    protected FriendsErrorMetadata $metaData;

    public function __construct(
        string $message = "",
        int $code = 0,
        ?\Throwable $previous = null,
        FriendsErrorMetadata $metaData
    ) {
        parent::__construct($message, $code, $previous);

        $this->metaData = $metaData;
    }

    public function getErrorMetaData(): FriendsErrorMetadata
    {
        return $this->metaData;
    }
}