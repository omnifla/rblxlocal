<?php

// written by omnifla

namespace Roblox\Friends\Client;

interface FollowRequestSent
{
    public function __invoke(
        int $userId,
        int $followerUserId
    ): void;
}