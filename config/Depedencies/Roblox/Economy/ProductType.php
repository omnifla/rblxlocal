<?php
// ported by meditext
// yk, fun fact: I literally hate values being fetched from the DB.
namespace Roblox\Economy;

class ProductType
{
    public static array $ProductTypes = [
        1 => "ROBLOX Product",
        2 => "User Product",
        3 => "Resellable Product",
        4 => "Developer Product",
        5 => "Private Server Product",
        6 => "Game Pass",
        7 => "Package Product"
    ];

	public static function Get(?int $id)
	{
		if ($id)
		{
			return self::$ProductTypes[$id];
		}
		return null;
	}

	public static function GetTotalNumberOfProductTypes()
	{
		return count($ProductTypes);
	}
}
