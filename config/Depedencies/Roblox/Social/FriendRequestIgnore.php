<?php

namespace Roblox\Social;

interface FriendRequestIgnore
{
    public function __invoke(int $senderUserId, int $recipientUserId, bool $isInGame, bool $isInApp): void;
}
