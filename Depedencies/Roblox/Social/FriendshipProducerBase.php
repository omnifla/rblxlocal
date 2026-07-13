<?php

// written by omnifla

namespace Roblox\Social;

use Roblox\ApiClientBase\IFriendsClient;
use Roblox\UserBlock\Core\IUserBlockAuthority;
use Roblox\Membership\IUser;

abstract class FriendshipProducerBase
{
    protected IFriendsClient $client;
    protected IUserBlockAuthority $userBlockAuthority;

    public function __construct(
        IFriendsClient $client,
        IUserBlockAuthority $userBlockAuthority
    ) {
        $this->client = $client;
        $this->userBlockAuthority = $userBlockAuthority;
    }

    protected function blockExistsBetweenUsers(
        IUser $user,
        IUser $otherUser
    ): bool {
        return
            $this->userBlockAuthority->hasBlock($user, $otherUser) ||
            $this->userBlockAuthority->hasBlock($otherUser, $user);
    }
}