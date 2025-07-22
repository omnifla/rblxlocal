<?php
// rewritten by medtext
// why the hell did i put AW code here before :sob:
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
header("Content-Type: application/json");
$username = $_GET["username"];
try{
   Auth::ValidateUsername($username);
}catch(\Exception $e){
   exit('{"success": false}');
}
exit('{"success": true}');
?>