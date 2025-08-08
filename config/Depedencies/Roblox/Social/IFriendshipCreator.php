<?php
namespace Roblox\Social;

use Roblox\Friends\Client\FriendRequestSent;

interface IFriendshipCreator
{
    public function onFriendRequestSent(FriendRequestSent $callback): void;
    public function sendFriendRequest(
        int $userId,
        int $recipientId,
        AntiAbuseFlags $antiAbuseFlags,
        string $message = '',
        int $friendshipOriginSourceType = 0
    ): void;
}
