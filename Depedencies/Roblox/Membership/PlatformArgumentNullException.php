<?php
// written by omnifla

namespace Roblox\Membership;

class PlatformArgumentNullException extends \InvalidArgumentException
{
    public function __construct(string $parameterName)
    {
        parent::__construct("Argument cannot be null: {$parameterName}");
    }
}