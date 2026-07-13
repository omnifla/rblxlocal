<?php
// written and ported by SkylerClock
namespace Roblox;

use Roblox\DataAccess\UserFeedDAL;

class UserFeed
{
    private UserFeedDAL $dal;

    public function __construct(?UserFeedDAL $dal = null)
    {
        $this->dal = $dal ?? new UserFeedDAL();
    }

    public function getId(): int
    {
        return $this->dal->post_id;
    }

    public function getUserId(): int
    {
        return $this->dal->author_id;
    }

    public function getContent(): string
    {
        return $this->dal->content;
    }

    public function getPostedAt(): int
    {
        return $this->dal->posted_at;
    }

    public function save(): void
    {
        if ($this->dal->post_id === 0) {
            $this->dal->insert();
        } else {
            $this->dal->update();
        }
    }

    public static function get(int $id): ?UserFeed
    {
        $dal = UserFeedDAL::get($id);
        return $dal ? new UserFeed($dal) : null;
    }

    public static function getRecent(int $limit = 20): array
    {
        $dals = UserFeedDAL::getRecent($limit);
        return array_map(fn($dal) => new UserFeed($dal), $dals);
    }

    public static function getByAuthor(int $userId, int $limit = 20): array
    {
        $dals = UserFeedDAL::getByAuthor($userId, $limit);
        return array_map(fn($dal) => new UserFeed($dal), $dals);
    }

    public function getDAL(): UserFeedDAL
    {
        return $this->dal;
    }
    
    public function getFeedContent(): ?string
    {
        return $this->dal->content ?? null;
    }

    public function getFeedPostTime(): ?int
    {
        return $this->dal->posted_at ?? null;
    }

    public function getFeedAuthorId(): ?int
    {
        return $this->dal->author_id ?? null;
    }

    public function getPostId(): int
    {
        return $this->dal->post_id ?? 0;
    }
}
