<?php

namespace Roblox\Friends\Client;

interface FriendRequestAccepted
{
    public function __invoke(int $friendRequestId, int $accepterUserId, ?int $senderUserId): void;
}
