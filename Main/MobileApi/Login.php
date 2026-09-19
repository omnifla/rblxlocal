<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Moderation\Punishment;
use Roblox\Moderation\PunishmentType;
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
try {
	$user = Auth::Login($username, $password);
} catch (Exception $e) {
	exit(json_encode(["Status" => "Error", "Message" => $e->getMessage()]));
}

// ban check
if ((int) $user['account_status_id'] === 2) {
	Punishment::deactivateExpiredPunishments();

	$recheck = $conn->prepare("SELECT account_status_id FROM users WHERE id = :id LIMIT 1");
	$recheck->execute([':id' => $user['id']]);
	if ((int) $recheck->fetchColumn() === 2) {
		$pStmt = $conn->prepare("
			SELECT * FROM punishments
			WHERE user_id = :uid AND active = TRUE
			ORDER BY id DESC LIMIT 1
			");
		$pStmt->execute([':uid' => $user['id']]);
		$p = $pStmt->fetch(PDO::FETCH_ASSOC);
		exit(json_encode([
			"Status" => "AccountNotApproved",
			"PunishmentInfo" => [
				"PunishmentType" => PunishmentType::GetById((int) ($p['punishment_type'] ?? 0)),
				"MessageToUser" => $p['reason'] ?? '',
				"BeginDateString" => isset($p['start_date']) ? date('n/j/Y g:i:s A', strtotime($p['start_date'])) : '',
				"EndDateString" => isset($p['end_date']) ? date('n/j/Y g:i:s A', strtotime($p['end_date'])) : '',
			]
		]));
	}
}

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