<?php
// ported by meditext
namespace Roblox\Economy\Common;
use Roblox\Authentication as Auth;
use PDO;
use Exception;
class RobuxBalanceDAL
{
	private static $db;

	public static int $UserID;

	public static int $Value;

	public function __construct(){
		global $conn;
		self::$db = $conn;
	}
	public function Credit(int $amount)
	{
		if ($amount < 1)
		{
			throw new Exception("Required value not specified: Amount.");
		}
		// i suppose this increments the value via the amount
        $getvalue = self::Get(self::$UserID);
        if(!$getvalue)
        {
            throw new Exception("User Requested is not valid.");
        }
		$outputValue = $getvalue + $amount;
        $stmt = self::$db->prepare("UPDATE users SET robux = :val");
        if(!$stmt->execute([":val" => $outputValue])){
            throw new Exception("Failed to update the ROBUX value.");
        }
		self::$Value = $outputValue;
	}

	public function TryDebit(int $amount) : bool
	{
		if ($amount < 1)
		{
			throw new Exception("Required value not specified: Amount.");
		}
        $getvalue = self::Get(self::$UserID);
        if(!$getvalue)
        {
            throw new Exception("User Requested is not valid.");
        }
		
		$outputValue = $getvalue - $amount;
        if($outputValue < 0){
            // let's just prevent a negative logic happens
            return false;
        }
        $stmt = self::$db->prepare("UPDATE users SET robux = :val");
		self::$Value = $outputValue;
		return (bool)$stmt->execute([":val" => $outputValue]);
	}

	public static function BuildDAL($userId, $value) : RobuxBalanceDAL
	{
		$dal = new RobuxBalanceDAL();
		$dal::$UserID = $userId;
		$dal::$Value = $value;
		
		return $dal;
	}

	public static function Get(int $userid = 0)
	{
		if ($userid == 0)
		{
			return null;
		}
        $userinfo = Auth::GetUserInfo($userid);
        if(!$userinfo){
            return null;
        }
		return $userinfo['robux'];
	}
}
