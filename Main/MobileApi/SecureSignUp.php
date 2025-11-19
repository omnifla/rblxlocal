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

$username = $parsedPost['userName'];
$password = $parsedPost['password'];
$gender = $parsedPost['gender'] == "Male" ? 1 : 2;
$dt = DateTime::createFromFormat('m/d/Y', $parsedPost['dateOfBirth']);
if (!$dt) {
    exit(json_encode(["Status" => "Error", "Message" => "Invalid DateOfBirth format"]));
}
$dateOfBirth = $dt->format('Y-m-d');
$email = $parsedPost['email'] ?? ""; // maybe we will ignore emails for now.
try{
    $uid = Auth::Register($username, $password,  $gender, $email, $dateOfBirth);
}catch(Exception $e){
    exit(json_encode(["Status" => "Error", "Message" => $e->getMessage()]));
}
$user = Auth::GetUserInfo($uid);
if(!$user)
    exit(json_encode(["Status" => "Error", "Message" => "Account Registration failed, Please try again."]));

$response = [
    "Status" => "OK",
    "UserInfo" => [
		"UserID" => $user['id'],
		"UserName" => $user['username'],
		"RobuxBalance" => $user['robux'],
		"TicketsBalance" => $user['tickets'],
		"IsAnyBuildersClubMember" => $user['membership_type'] > 0,
		"ThumbnailUrl" => $site_properties['baseUrl'] . "/Thumbs/Avatar.ashx?userId=" . $user['id'],
	]
];

exit(json_encode($response));
?>