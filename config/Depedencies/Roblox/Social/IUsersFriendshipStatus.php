<?php

namespace Roblox\Platform\Social;

interface IUsersFriendshipStatus
{
    public function getInitiatingUserId(): int;
    public function getOtherUserId(): int;
    public function getFriendshipStatus(): FriendshipStatus;
}
