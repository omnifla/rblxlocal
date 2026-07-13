<?php

// written by omnifla

namespace Roblox\Permissions\Core;

class PermissionsStatus
{
    public function __construct(
        protected bool $tested = true,
        protected bool $success = true
    ) {}

    public function wasTested(): bool
    {
        return $this->tested;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function __toString(): string
    {
        return json_encode([
            'tested' => $this->tested,
            'success' => $this->success
        ]);
    }
}