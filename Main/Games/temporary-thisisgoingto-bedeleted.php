<?php
// DEFINITIVELY NOT WRITTEN BY MEDITEXT
require_once $_SERVER['DOCUMENT_ROOT']. "/../config/main.php";
use Roblox\Authentication;
$url = urlencode(str_replace("https:", "http:",$site_properties['baseUrl']."/Game/PlaceLauncher.ashx?placeId=1818"));
$time = time();
$cookie = $_COOKIE['_ROBLOSECURITY'] ?? 0;
?>
<html>  
    <a href="<?= $_ENV['PLAYER_PREFIX'].":1+launchmode:play+gameinfo:{$cookie}+launchtime:{$time}+placelauncherurl:{$url}+browsertrackerid:0" ?>">Join here</a>
</html>