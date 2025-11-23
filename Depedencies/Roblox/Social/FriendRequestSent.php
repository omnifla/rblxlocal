<?php

namespace Roblox\Social;

interface FriendRequestSent
{
    public function __invoke(int $senderUserId, int $recipientUserId, bool $inGame, bool $inApp): void;
}
