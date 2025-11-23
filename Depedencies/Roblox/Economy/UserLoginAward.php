<?php
// ported by meditext

namespace Roblox\Economy;
use Roblox\Economy\UserLoginAwardDAL;
use Roblox\Economy\Common\TransactionHistory;
use Roblox\Economy\Common\TransactionType;
use Roblox\Economy\Common\TransactionOriginType;
use DateTime;

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

        TransactionHistory::submit(
            $this->dal->userId,
            TransactionType::CreditID,
            TransactionOriginType::DailyLoginAwardID,
            2,
            10
        );
        return $this->dal->trySetDailyAward();
    }
}