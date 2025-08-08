<?php
// written by meditext
// stub api, lets just use this for now
// this will be replaced eventually to use Roblox.Platform.Chat system + using the Friends system.
require_once $_SERVER["DOCUMENT_ROOT"] . '/../config/main.php';
use Roblox\Authentication as Auth;
header('Content-Type: application/json');

$cmd = $_GET['cmd'];
$chatData = ["Error" => "", "Count" => 0, "Users" => []];
$getFriendedUser = function ($uid) use ($chatData) {
	$getUser = Auth::GetUserInfo($uid);
    if (!$getUser) {
        return;
    }
	$chatData['Users'][] = [
		"ID" => $getUser['id'],
		"Name" => $getUser['username'],
		"Online" => "false",
		"Thumbnail" => "/Thumbs/User.ashx?ID={$getUser['id']}&Width=210&Height=210",
		"CanAcceptChats" => true,
		"ShowInviteLink" => false
	];
};
switch ($cmd) {
    case "friends":
        if (!Auth::GetAuthenticatedUser()) {
            header("Location: /newlogin");
            exit;
        }
        $getFriendedUser(1); // default ROBLOX account set as friend.
        break;
    case "recents":
        if (!Auth::GetAuthenticatedUser()) {
            header("Location: /newlogin");
            exit;
        }
        // stub, TODO: implement recently chatted friends.
        break;
    case "bestfriends":
        if (!Auth::GetAuthenticatedUser()) {
            header("Location: /newlogin");
            exit;
        }
        // stub
        break;
    default:
        http_response_code(400);
        $chatData['Error'] = "Invalid command";
        exit(json_encode($chatData));
}
$chatData['Count'] = count($chatData['Users']);
exit(json_encode($chatData));
?>