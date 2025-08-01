<?php
// all this does is get a rccservice instance and returns RCCServiceSoap
// whats the point??

namespace Roblox\Grid\Common;
use Roblox\Grid\Rcc\RCCServiceSoap;

class GridServiceUtils {
    public static function GetService(string $Address = '127.0.0.1', int $Port = 64989) : RCCServiceSoap {
        if (!$Address)
            throw new \InvalidArgumentException('Bad address, does not exist.');
        
        return new RCCServiceSoap($Address, $Port);
    }
}