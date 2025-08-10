<?php
// ported by meditext
namespace Roblox\Grid\Common;
use Roblox\Grid\Rcc;
class GridServiceUtils
{
	public static function GetService(string $address, int $port) : RCCServiceSoap
	{
		if ($address == null)
		{
			return null;
		}
		$rCCServiceSoap  = new RCCServiceSoap($address, $port);
		return $rCCServiceSoap;
	}
}
