<?php

// written by omnifla

namespace Roblox\Membership;

interface IUserFactory
{
    public function getUser(int $userId): ?object;
}