<?php
// writen by chloe & meditext
// this is legit so confusin holy shit
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
use Roblox\Authentication as Auth;
use Roblox\Thumbs\Avatar;
$id = intval($_GET['userId'] ?? 0);
$width = intval($_GET['x'] ?? 150);
$height = intval($_GET['y'] ?? 150);
$avatar = new Avatar();

    $request = $avatar->requestThumbnail($id, $width, $height, 'png');
header("Location: {$request['url']}");
exit;
?>