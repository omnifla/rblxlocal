<?php
// written by meditext
// stub api, lets just use this for now
// this will be replaced eventually to use Roblox.Platform.Chat system.
require_once $_SERVER["DOCUMENT_ROOT"] . '/../config/main.php';
use Roblox\Authentication as Auth;
header('Content-Type:application/json');

$reqType = $_GET['reqType'];
$chatData = [
	"Error" => "",
	"PartyStatus" => null,
	"Party" => null,
	"Chats" => []
];
$getChat = function ($senderID, $showInviteLink = false, $hasNewMessages = false) use ($chatData) {
	/*
    a small reminder that if the player is in-game, it should be set the location under this table format:
    [
		"GameAssetName" => "string", // substr it to 16 characters.
		"GameAssetURL" => "string",
	    "GameThumbnailURL" => "string"
	];
    presence types:
    offline, website (that's all)
    */
    $getUser = Auth::GetUserInfo($uid);
    if (!$getUser) {
        return;
    }
	$location = "offline";
	$chatData['Chats'][] = [
		"SenderID" => $senderID,
		"SenderUserName" => $getUser['username'],
		"CachedOnClient" => false,
		"Online" => false,
		"Thumbnail" => "/Thumbs/User.ashx?ID={$getUser['id']}&Width=210&Height=210",
		"Location" => $location,
		"ShowInviteLink" => false,
		"HasNewMessages" => false,
		"Conversation" => []
	];
};
if ($reqType == "getallchatswithdata") {
    getChat(1);
}
else {
	$chatData['Error'] = "Invalid request";
}
exit(json_encode($chatData));
?>