<?php
// written by omnifla

namespace Roblox\ApiClientBase;

interface IFriendsClient
{
    public function sendFriendRequest(
        int $userId,
        int $recipientId,
        string $message = '',
        int $friendshipOriginSourceType = 0
    ): void;
}