<?php

// written by omnifla

namespace Roblox\Permissions\Core;

interface IPermissionsChecker
{
    public function checkPermissions(
        string $actionType,
        array $context = []
    ): PermissionsStatus;
}