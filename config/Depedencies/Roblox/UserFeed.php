<?php
// ported and written by SkylerClock
namespace Roblox;
use Roblox\DataAccess\FeedDAL;

class UserFeed
{
    private UserFeedDAL $dal;

    public function __construct(?UserFeedDAL $dal = null)
    {
        $this->dal = $dal ?? new UserFeedDAL();
    }

    public function getId(): int
    {
        return $this->dal->id;
    }

    public function getUserId(): int
    {
        return $this->dal->user_id;
    }

    public function setUserId(int $userId): void
    {
        $this->dal->user_id = $userId;
    }

    public function getFeedId(): int
    {
        return $this->dal->feed_id;
    }

    public function setFeedId(int $feedId): void
    {
        $this->dal->feed_id = $feedId;
    }

    public function save(): void
    {
        if ($this->dal->id === 0) {
            $this->dal->created_at = (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d H:i:s');
            $this->dal->insert();
        } else {
            $this->dal->update();
        }
    }

    public static function createNew(int $userId, int $feedId): UserFeed
    {
        $userFeed = new UserFeed();
        $userFeed->setUserId($userId);
        $userFeed->setFeedId($feedId);
        $userFeed->save();
        return $userFeed;
    }

    public static function get(int $id): ?UserFeed
    {
        $dal = UserFeedDAL::get($id);
        return $dal ? new UserFeed($dal) : null;
    }

    public static function exists(int $userId, int $feedId): bool
    {
        return UserFeedDAL::getByUserAndFeedId($userId, $feedId) !== null;
    }

    public static function getByUserIdPaged(int $userId, int $start, int $limit): array
    {
        $ids = UserFeedDAL::getIdsByUserIdPaged($userId, $start, $limit);
        $result = [];
        foreach ($ids as $id) {
            $feed = self::get($id);
            if ($feed !== null) {
                $result[] = $feed;
            }
        }
        return $result;
    }

    public static function multiGet(array $ids): array
    {
        $dals = UserFeedDAL::multiGet($ids);
        return array_map(fn($dal) => new UserFeed($dal), $dals);
    }

    public function equals(UserFeed $other): bool
    {
        return $this->getId() === $other->getId();
    }

    public function getDAL(): UserFeedDAL
    {
        return $this->dal;
    }
}
