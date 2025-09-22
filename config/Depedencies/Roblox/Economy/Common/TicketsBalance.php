<?php
// ported by meditext
namespace Roblox\Economy\Common;
use Roblox\Economy\Common\TicketsBalanceDAL;
use DateTime;

class TicketsBalance {
	public int $UserID;
	public int $Value;
    public TicketsBalanceDAL $dal;
	public function __construct($userId){
        $this->UserID = $userId;
        $this->Value = TicketsBalanceDAL::Get($userId);
		$this->dal = TicketsBalanceDAL::BuildDAL($userId, $this->Value);
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
