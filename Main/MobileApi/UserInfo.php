<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Economy\Common\RobuxBalance;
use Roblox\Economy\Common\TicketsBalance;
header("Content-Type: application/json");

$user = Auth::GetAuthenticatedUser();
if(!$user){
    Auth::Logout();
    exit(json_encode(["Status" => "Error", "Message" => "Failed to Fetch User info, logging out."]));
}
$robux = RobuxBalance::Get($user['id']);
$tickets = TicketsBalance::Get($user['id']);
$response = [
        "Status" => "OK",
        "UserInfo" => [
		"UserID" => $user['id'],
		"UserName" => $user['username'],
		"RobuxBalance" => $robux->Value,
		"TicketsBalance" => $tickets->Value,
		"IsAnyBuildersClubMember" => $user['membership_type'] > 0,
		"ThumbnailUrl" => $site_properties['baseUrl'] . "/Thumbs/Avatar.ashx?userId=" . $user['id'],
	]
];

exit(json_encode($response));
?>