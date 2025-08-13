<?php
// written by meditext
// stub api, lets just use this for now
// this will be replaced eventually to use Roblox.Platform.Chat system.
require_once $_SERVER["DOCUMENT_ROOT"] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\TextFilter\BasicTextFilter;
header('Content-Type:application/json');

$recipient = $_GET["recipientUserId"];
$chatData = [
	"Error" => null,
];
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $chatData['Error'] = "Invalid request";
    exit(json_encode($chatData));
}
$message = $_POST["message"];
if(!Auth::GetUserInfo(intval($recipient))){
    $chatData['Error'] = "Recipient user not found";
    exit(json_encode($chatData));
}
$filter_test = new BasicTextFilter();
$message = $filter_test->filter($_POST["message"]);
if($message->isFiltered){
    $chatData['Error'] = "ModeratedMessage";
    exit(json_encode($chatData));
}
exit(json_encode($chatData)); // stub
?>