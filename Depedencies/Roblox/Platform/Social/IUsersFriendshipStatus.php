<?php

namespace Roblox\Platform;

interface IUsersFriendshipStatus
{
    public function getInitiatingUserId(): int;
    public function getOtherUserId(): int;
    public function getFriendshipStatus(): FriendshipStatus;
}
