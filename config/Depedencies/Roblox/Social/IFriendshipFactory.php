<?php

namespace Roblox\Social;

use Roblox\ApiClientBase\ExclusiveStartInfo;
use Roblox\Caching\Shared\ISharedCacheClient;
use Roblox\Friends\Client\FriendRequestAccepted;
use Roblox\Friends\Client\FollowRequestSent;
use Roblox\Friends\Client\FriendRequestAccept;
use Roblox\Friends\Client\FriendRequestIgnore;
use Roblox\Friends\Client\FriendRequestUnfriend;
use Roblox\Membership\IUser;

interface IFriendshipFactory
{
    public function onFriendRequestAccepted(FriendRequestAccepted $callback): void;
    public function onFollowRequestSent(FollowRequestSent $callback): void;
    public function onFriendRequestAccept(FriendRequestAccept $callback): void;
    public function onFriendRequestIgnore(FriendRequestIgnore $callback): void;
    public function onFriendRequestUnfriend(FriendRequestUnfriend $callback): void;
    public function getFollowersCount(int $userId): int;
    public function getFollowingsCount(int $userId): int;
    public function hasFollower(int $userId, int $followerUserId): bool;
    public function getFollowing(int $userId, int $followerUserId): ?IFollowing;
    // both were deprecated on the roblox backend, use getFollowersEnumerative and getFollowingsEnumerative instead.
    // public function getFollowers(int $userId, int $startRowIndex, int $maximumRows): array;
    //public function getFollowings(int $userId, int $startRowIndex, int $maximumRows): array;
    public function getFollowersEnumerative(int $userId, ExclusiveStartInfo $exclusiveStartKeyInfo): array;
    public function getFollowingsEnumerative(int $userId, ExclusiveStartInfo $exclusiveStartKeyInfo): array;
    public function createFollowing(
        IUser $user,
        IUser $follower,
        bool $isFollowerInGame,
        bool $isUserInSameGameAsFollower,
        bool $isFollowerInApp,
        bool $hasFollowerFilledACaptcha
    ): void;
    public function deleteFollowing(IUser $user, IUser $follower): void;
    public function multigetFollowingDetails(int $userId, array $otherUserIds): array;
    public function getFriendRequests(int $userId, int $startRowIndex, int $maximumRows): array;
    public function getFriendRequestsEnumerative(int $userId, ExclusiveStartInfo $exclusiveStartKeyInfo): array;
    public function getFriendRequestsCount(int $userId): int;
    public function getFriendRequest(?int $friendRequestId, ?int $senderUserId = null, ?int $accepterUserId = null): ?IFriendRequest;
    public function attemptFriendshipHandshake(
        int $senderUserId,
        int $recipientId,
        bool $isInGame,
        bool $isInApp,
        int $senderFriendshipOriginSourceType
    ): bool;
    public function acceptFriendRequest(
        int $accepterUserId,
        int $friendRequestId,
        int $senderUserId,
        bool $isInGame,
        bool $isInApp,
        int $friendshipOriginSourceType = 0
    ): void;
    public function declineFriendRequest(
        int $declinerUserId,
        int $friendRequestId,
        bool $isInGame,
        bool $isInApp,
        ?int $senderUserId = null
    ): void;
    public function multigetPendingFriendRequests(int $userId, array $otherUserIds);
    public function hasRequest(int $userId, int $friendId): bool;
    public function getFriendshipStatus(int $userId, int $friendId): FriendshipStatus;
    public function multigetFriendshipStatus(int $userId, array $otherUserIds): array;
    public function getFriends(int $userId, int $startRowIndex, int $maximumRows): array;
    public function getAllFriends(IUser $user): array;
    public function getFriendsCount(int $userId): int;
    public function getFriendship(int $userId, int $friendId): ?IFriend;
    public function removeFriend(int $userId, int $friendId, bool $isInGame, bool $isInApp): void;
    public function createFriendship(int $userId, int $friendId): void;
    public function areFriends(int $userId, int $friendId): bool;
    public function getUsersOfInterestPaged(
        IUser $user,
        int $startRowIndex,
        int $maximumRows,
        ISharedCacheClient $cacheClient,
        callable $onlineStatusGetter
    ): array;
}
