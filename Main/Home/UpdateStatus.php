<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\TextFilter\BasicTextFilter;

header("Content-Type: application/json");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$filter = new BasicTextFilter();
$rawStatus = $_POST['status'] ?? null;

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


$insert_stmt = $conn->prepare("INSERT INTO feeds (author_id, content, posted_at) VALUES (:user_id, :status, :created_at)");
$insert_stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$insert_stmt->bindParam(':status', $status, PDO::PARAM_STR);
$insert_stmt->bindParam(':created_at', $time_posted, PDO::PARAM_STR);

if ($insert_stmt->execute()) { 
    exit('{"success": true, "message": "Status updated successfully."}');
} else {
    exit('{"success": false, "message": "Could not update status. Please try again later."}');
}