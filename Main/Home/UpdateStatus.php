<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\TextFilter\BasicTextFilter;

header("Content-Type: application/json");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$filter = new BasicTextFilter();
$rawStatus = $_POST['status'] ?? null;

exit('{"success": false, "message": "Feeds have been disabled temporarily."}');

if (!Auth::GetAuthenticatedUser()) {
    echo '{"success": false, "message": "You must be logged in to update your status."}';
    exit;
}

$user = Auth::GetAuthenticatedUserInfo();

if ($rawStatus === null || trim($rawStatus) === '') {
    echo '{"success": false, "message": "Status cannot be empty."}';
    exit;
}

$filtered = $filter->filter($rawStatus)->getFilteredText();
$status = mb_substr((string)$filtered, 0, 1000, 'UTF-8');

if (mb_strlen($status, 'UTF-8') > 150) {
    echo '{"success": false, "message": "Status must be 150 characters or less."}';
    exit;
}

$time = time();
$checkLimit =  $conn->prepare("SELECT * FROM feeds WHERE posted_at < :time - 60 AND author_id = :user_id LIMIT 5");
$checkLimit->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$checkLimit->bindParam(':time', $time, PDO::PARAM_STR);
$checkLimit->execute();
if($checkLimit->rowCount() >= 4){
    exit('{"success": false, "message": "You are being rate limited, please try again later."}');
}

$insert_stmt = $conn->prepare("INSERT INTO feeds (author_id, content, posted_at) VALUES (:user_id, :status, :created_at)");
$insert_stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$insert_stmt->bindParam(':status', $status, PDO::PARAM_STR);
$insert_stmt->bindParam(':created_at', $time, PDO::PARAM_STR);

if ($insert_stmt->execute()) { 
    exit('{"success": true, "message": "Status updated successfully."}');
} else {
    exit('{"success": false, "message": "Could not update status. Please try again later."}');
}
