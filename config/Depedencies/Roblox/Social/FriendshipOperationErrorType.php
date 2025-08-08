<?php

namespace Roblox\Social;

enum FriendshipOperationErrorType: int
{
    case AlreadyExists = 2;
    case InvalidParameters = 3;
    case SelfFriendingAttempt = 6;
    case SelfFollowingAttempt = 7;
    case NotRecipient = 8;
    case FloodLimitExceeded = 9;
    case DoesNotExist = 10;
    case CurrentUserFriendsLimitExceeded = 12;
    case OtherUserFriendsLimitExceeded = 13;
    case InvalidUser = 14;
    case BannedUser = 15;
    case BlockedUser = 16;
    case UsersAreNotInSameGame = 17;
    case UserHasNotPassedCaptcha = 18;
    case PermissionsCheckUnsuccessful = 19;
    case PolicyCheckUnsuccessful = 20;
}
