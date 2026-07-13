<?php

// written by omnifla

namespace Roblox\Core;

class PlatformException extends \Exception
{
    public function shouldSkipLogging(): bool
    {
        return false;
    }
}