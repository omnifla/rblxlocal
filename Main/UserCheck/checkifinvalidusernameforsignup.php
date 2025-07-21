<?php
// written by meditext, taken from the AFTERWORLD's source code.
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\TextFilter\BasicTextFilter;
$filter = new BasicTextFilter();
//include_once $_SERVER['DOCUMENT_ROOT'] . '/config/miscfunctions.php';
header("Content-Type: application/json");
$username = (string) $_GET["username"];
// reference data
/*
REFERENCE DATA:
1: Already taken
2: Can't Use (Roblox, LocalPlayer)

*/
$check = $filter->filter($username);
if($check->isFiltered()) {
    exit('{"data": 2}');
}

try {
    Auth::ValidateUsername($username);
} catch (\InvalidArgumentException $e) {
   exit('{"data": 1}');
}
exit('{"data": 0}');
?>
