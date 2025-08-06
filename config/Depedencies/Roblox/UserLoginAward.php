<?php
// ported by meditext
// this is a trimmed-down version of UserLoginAward.cs with only the necessary features

namespace Roblox;

use DateTime;
use Roblox\DataAccess\UserLoginAwardDAL;

class UserLoginAward
{
    public function __construct(
        private UserLoginAwardDAL $dal
    ) {}

    public static function getOrCreate(int $userId): ?self
    {
        $dal = UserLoginAwardDAL::getOrCreate($userId);
        return $dal ? new self($dal) : null;
    }

    public function tryAward(): bool
    {
        $lastAwarded = $this->dal->getLastAwarded();

        if ($lastAwarded instanceof DateTime && $lastAwarded > (new DateTime('-1 day'))) {
            return false;
        }

        return $this->dal->trySetDailyAward();
    }
}