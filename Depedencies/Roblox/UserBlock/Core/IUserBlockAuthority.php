<?php

// written by omnifla

namespace Roblox\UserBlock\Core;

use Roblox\Membership\IUser;

interface IUserBlockAuthority
{
    public function hasBlock(
        IUser $user,
        IUser $target
    ): bool;
}