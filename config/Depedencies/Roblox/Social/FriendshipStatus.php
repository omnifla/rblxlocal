<?php

namespace Roblox\Social;

enum FriendshipStatus: int
{
    case NoFriendship = 0;
    case PendingOnOtherUser = 1;
    case PendingOnCurrentUser = 2;
    case Friends = 3;
}
