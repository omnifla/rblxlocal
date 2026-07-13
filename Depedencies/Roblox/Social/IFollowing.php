<?php

// written by omnifla

namespace Roblox\Social;

interface IFollowing
{
    public function getUserId(): int;

    public function getFollowerUserId(): int;
}