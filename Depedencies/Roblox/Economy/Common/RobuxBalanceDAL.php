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

	public function __construct()
	{
		global $conn;
		self::$db = $conn;
	}
	public function Credit(int $amount)
	{
		if ($amount < 1) {
			throw new Exception("Required value not specified: Amount.");
		}
		$getvalue = self::Get(self::$UserID);
		if ($getvalue === null) {
			throw new Exception("User Requested is not valid.");
		}
		$outputValue = $getvalue + $amount;
		$stmt = self::$db->prepare("UPDATE users SET robux = :val WHERE id = :uid");
		if (!$stmt->execute([":val" => $outputValue, ":uid" => self::$UserID])) {
			throw new Exception("Failed to update the ROBUX value.");
		}
		self::$Value = $outputValue;
	}

	public function TryDebit(int $amount): bool
	{
		if ($amount < 1) {
			throw new Exception("Required value not specified: Amount.");
		}
		$getvalue = self::Get(self::$UserID);
		if ($getvalue === null) {
			throw new Exception("User Requested is not valid.");
		}

		$outputValue = $getvalue - $amount;
		if ($outputValue < 0) {
			return false;
		}
		$stmt = self::$db->prepare("UPDATE users SET robux = :val WHERE id = :uid");
		self::$Value = $outputValue;
		return (bool) $stmt->execute([":val" => $outputValue, ":uid" => self::$UserID]);
	}

	public static function BuildDAL($userId, $value): RobuxBalanceDAL
	{
		$dal = new RobuxBalanceDAL();
		$dal::$UserID = $userId;
		$dal::$Value = $value;

		return $dal;
	}

	public static function Get(int $userid = 0)
	{
		if ($userid == 0) {
			return null;
		}
		$userinfo = Auth::GetUserInfo($userid);
		if (!$userinfo) {
			return null;
		}
		if ($userinfo['robux'] === null) {
			return null;
		}
		return (int) $userinfo['robux'];
	}
}