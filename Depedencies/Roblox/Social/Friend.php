<?php
namespace Roblox\Social;

class Friend implements IFriend
{
    private int $userId;
    private \DateTime $friendsSince;

    public function __construct(int $userId = 0, ?\DateTime $friendsSince = null)
    {
        $this->userId = $userId;
        $this->friendsSince = $friendsSince ?? new \DateTime();
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getFriendsSince(): \DateTime
    {
        return $this->friendsSince;
    }

    public function setFriendsSince(\DateTime $friendsSince): void
    {
        $this->friendsSince = $friendsSince;
    }
}
