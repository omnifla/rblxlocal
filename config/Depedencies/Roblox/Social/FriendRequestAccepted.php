<?php

namespace Roblox\Social;

interface FriendRequestAccepted
{
    public function __invoke(int $friendRequestId, int $accepterUserId, ?int $senderUserId): void;
}
