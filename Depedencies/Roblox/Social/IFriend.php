<?php

namespace Roblox\Social;

interface IFriend
{
    public function getUserId(): int;
    public function getFriendsSince(): \DateTime;
}
