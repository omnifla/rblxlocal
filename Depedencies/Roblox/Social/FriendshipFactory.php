<?php

namespace Roblox\Social;

use Roblox\ApiClientBase\ApiClientException;
use Roblox\Friends\Client\FriendsClientException;
use Roblox\Membership\PlatformArgumentException;
use Roblox\Membership\PlatformArgumentNullException;
use Roblox\Social\Exceptions\FriendshipOperationException;
use Roblox\Social\Exceptions\FriendshipOperationUnavailableException;
use Roblox\UserBlock\Core\CircuitBreakerException;

class FriendshipFactory
{
    protected $client;
    protected const SERVICE_UNAVAILABLE_MSG = "Friends Service Unavailable";

    public function __construct($client)
    {
        $this->client = $client;
    }

    private function executeWithFriendshipHandling(callable $action)
    {
        try {
            return $action();
        } catch (FriendsClientException $ex) {
            throw new FriendshipOperationException($ex->getErrorMetaData(), 0, $ex);
        } catch (ApiClientException | CircuitBreakerException $ex) {
            throw new FriendshipOperationUnavailableException(self::SERVICE_UNAVAILABLE_MSG, 0, $ex);
        }
    }

    private function ensurePositive(int $value, string $name): void
    {
        if ($value <= 0) {
            throw new PlatformArgumentException("Invalid parameter: {$name} ({$value})");
        }
    }

    private function ensureNotNull($value, string $name): void
    {
        if ($value === null) {
            throw new PlatformArgumentNullException($name);
        }
    }

    public function getFriends(int $userId, int $page = 1, int $pageSize = 10): array
    {
        return $this->executeWithFriendshipHandling(function () use ($userId, $page, $pageSize) {
            $this->ensurePositive($userId, 'userId');
            $this->ensurePositive($page, 'page');
            $this->ensurePositive($pageSize, 'pageSize');
            return $this->client->getFriends($userId, $page, $pageSize);
        });
    }

    public function getFriendCount(int $userId): int
    {
        return $this->executeWithFriendshipHandling(function () use ($userId) {
            $this->ensurePositive($userId, 'userId');
            return $this->client->getFriendCount($userId);
        });
    }

    public function sendFriendRequest(int $fromUserId, int $toUserId): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($fromUserId, $toUserId) {
            $this->ensurePositive($fromUserId, 'fromUserId');
            $this->ensurePositive($toUserId, 'toUserId');
            return $this->client->sendFriendRequest($fromUserId, $toUserId);
        });
    }

    public function acceptFriendRequest(int $userId, int $friendId): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($userId, $friendId) {
            $this->ensurePositive($userId, 'userId');
            $this->ensurePositive($friendId, 'friendId');
            return $this->client->acceptFriendRequest($userId, $friendId);
        });
    }

    public function declineFriendRequest(int $userId, int $friendId): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($userId, $friendId) {
            $this->ensurePositive($userId, 'userId');
            $this->ensurePositive($friendId, 'friendId');
            return $this->client->declineFriendRequest($userId, $friendId);
        });
    }

    public function removeFriend(int $userId, int $friendId): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($userId, $friendId) {
            $this->ensurePositive($userId, 'userId');
            $this->ensurePositive($friendId, 'friendId');
            return $this->client->removeFriend($userId, $friendId);
        });
    }

    public function getFollowers(int $userId, int $page = 1, int $pageSize = 10): array
    {
        return $this->executeWithFriendshipHandling(function () use ($userId, $page, $pageSize) {
            $this->ensurePositive($userId, 'userId');
            $this->ensurePositive($page, 'page');
            $this->ensurePositive($pageSize, 'pageSize');
            return $this->client->getFollowers($userId, $page, $pageSize);
        });
    }

    public function getFollowersCount(int $userId): int
    {
        return $this->executeWithFriendshipHandling(function () use ($userId) {
            $this->ensurePositive($userId, 'userId');
            return $this->client->getFollowersCount($userId);
        });
    }

    public function getFollowing(int $userId, int $page = 1, int $pageSize = 10): array
    {
        return $this->executeWithFriendshipHandling(function () use ($userId, $page, $pageSize) {
            $this->ensurePositive($userId, 'userId');
            $this->ensurePositive($page, 'page');
            $this->ensurePositive($pageSize, 'pageSize');
            return $this->client->getFollowing($userId, $page, $pageSize);
        });
    }

    public function getFollowingCount(int $userId): int
    {
        return $this->executeWithFriendshipHandling(function () use ($userId) {
            $this->ensurePositive($userId, 'userId');
            return $this->client->getFollowingCount($userId);
        });
    }

    public function followUser(int $followerId, int $followeeId): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($followerId, $followeeId) {
            $this->ensurePositive($followerId, 'followerId');
            $this->ensurePositive($followeeId, 'followeeId');
            return $this->client->followUser($followerId, $followeeId);
        });
    }

    public function unfollowUser(int $followerId, int $followeeId): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($followerId, $followeeId) {
            $this->ensurePositive($followerId, 'followerId');
            $this->ensurePositive($followeeId, 'followeeId');
            return $this->client->unfollowUser($followerId, $followeeId);
        });
    }

    public function areFriends(int $userId1, int $userId2): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($userId1, $userId2) {
            $this->ensurePositive($userId1, 'userId1');
            $this->ensurePositive($userId2, 'userId2');
            return $this->client->areFriends($userId1, $userId2);
        });
    }

    public function isFollowing(int $followerId, int $followeeId): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($followerId, $followeeId) {
            $this->ensurePositive($followerId, 'followerId');
            $this->ensurePositive($followeeId, 'followeeId');
            return $this->client->isFollowing($followerId, $followeeId);
        });
    }

    public function hasPendingFriendRequest(int $fromUserId, int $toUserId): bool
    {
        return $this->executeWithFriendshipHandling(function () use ($fromUserId, $toUserId) {
            $this->ensurePositive($fromUserId, 'fromUserId');
            $this->ensurePositive($toUserId, 'toUserId');
            return $this->client->hasPendingFriendRequest($fromUserId, $toUserId);
        });
    }
}
