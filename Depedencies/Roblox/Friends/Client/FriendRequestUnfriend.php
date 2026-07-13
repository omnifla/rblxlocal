<?php

namespace Roblox\Friends\Client;

interface FriendRequestUnfriend
{
    public function __invoke(int $senderUserId, int $recipientUserId, bool $isInGame, bool $isInApp): void;
}
