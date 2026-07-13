<?php
// written by omnifla

namespace Roblox\ApiClientBase;

class ApiClientException extends \Exception
{
    protected array $metaData = [];

    public function __construct(
        string $message = "",
        int $code = 0,
        ?\Throwable $previous = null,
        array $metaData = []
    ) {
        parent::__construct($message, $code, $previous);

        $this->metaData = $metaData;
    }

    public function getErrorMetaData(): array
    {
        return $this->metaData;
    }
}