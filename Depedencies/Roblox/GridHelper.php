<?php
// written by meditext
namespace Roblox;
use Roblox\Grid\Common\GridServiceUtils;
use Roblox\Grid\Rcc\RCCServiceSoap;

class GridHelper{
    public static $service = null;
    public function __construct(){
        $this->service = GridServiceUtils::GetService("127.0.0.1", 64989); // TODO: Add support for Relay and Arbiter, make it use a masterlist;
    }
}
