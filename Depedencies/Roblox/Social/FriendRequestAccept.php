<?php

namespace Roblox\Social;

interface FriendRequestAccept
{
    public function __invoke(int $senderUserId, int $recipientUserId, bool $isInGame, bool $isInApp): void;
}
