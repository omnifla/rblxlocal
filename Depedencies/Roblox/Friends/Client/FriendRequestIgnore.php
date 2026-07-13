<?php

namespace Roblox\Friends\Client;

interface FriendRequestIgnore
{
    public function __invoke(int $senderUserId, int $recipientUserId, bool $isInGame, bool $isInApp): void;
}
