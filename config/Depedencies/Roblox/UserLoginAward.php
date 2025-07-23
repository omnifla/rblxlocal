<?php
// ported by meditext
// this is a trimmed down version of UserLoginAward.cs, as it lack some of the other necessary feautres, yet having the necessary ones.
namespace Roblox;
use Roblox\UserLoginAwardDAL;

class UserLoginAward
{
    private UserLoginAwardDAL $dal;

    public function __construct(UserLoginAwardDAL $dal)
    {
        $this->dal = $dal;
    }

    public static function getOrCreate(int $userId): ?UserLoginAward
    {
        $dal = UserLoginAwardDAL::getOrCreate($userId);
        return $dal ? new self($dal) : null;
    }

    public function tryAward(): bool
    {
        $lastAwarded = $this->dal->getLastAwarded();

        if ($lastAwarded && $lastAwarded > (new DateTime())->modify('-1 day')) {
            return false;
        }

        return $this->dal->trySetDailyAward();
    }
}
