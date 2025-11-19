<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Economy\Common\RobuxBalance;
use Roblox\Economy\Common\TicketsBalance;
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit(json_encode(["Status" => "Error", "Message" => "Invalid request method"]));
}
$rawPostData = file_get_contents('php://input');
$parsedPost = [];
parse_str($rawPostData, $parsedPost);

$username = $parsedPost['username'];
$password = $parsedPost['password'];
try{
    $login = Auth::Login($username, $password);
}catch(Exception $e){
    exit(json_encode(["Status" => "Error", "Message" => $e->getMessage()]));
}
$user = Auth::GetAuthenticatedUser();
if(!$user)
    exit(json_encode(["Status" => "Error", "Message" => "Login attempt failed; Please try again."]));

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