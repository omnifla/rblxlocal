<?php
// ported by meditext
namespace Roblox\Economy\Common;
use Roblox\Economy\Common\RobuxBalanceDAL;
use DateTime;

class RobuxBalance {
	public int $UserID;
	public int $Value;
    public RobuxBalanceDAL $dal;
	public function __construct($userId){
        $this->UserID = $userId;
        $this->Value = RobuxBalanceDAL::Get($userId);
		$this->dal = RobuxBalanceDAL::BuildDAL($userId, $this->Value);
    }

	public function Credit(int $amount = 0)
	{
		if ($amount != 0)
		{
			$this->dal->Credit($amount);
		}
	}

	public function TryDebit(int $amount) : bool
	{
		$num = self::$dal->TryDebit($amount);
		return $num;
	}
}
