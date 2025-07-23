<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\TextFilter\BasicTextFilter;
header("Content-Type: application/json");
$filter = new BasicTextFilter();
$status = $_POST['status'] ?? null;
if(!Auth::GetAuthenticatedUser()) {
    exit('{"success": false, "message": "You must be logged in to update your status."}');
}
$user = Auth::GetAuthenticatedUserInfo();
if ($status === null || trim($status) === '') {
    exit('{"success": false, "message": "Status cannot be empty."}');
}
$status = $filter->filter($status)->getFilteredText();
$time_posted = time();

$insert_stmt = $conn->prepare("INSERT INTO feeds (author_id, content, posted_at) VALUES (:user_id, :status, :created_at)");
$insert_stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$insert_stmt->bindParam(':status', $status, PDO::PARAM_STR);
$insert_stmt->bindParam(':created_at', $time_posted, PDO::PARAM_STR);

if ($insert_stmt->execute()) { 
    exit('{"success": true, "message": "Status updated successfully."}');
} else {
    exit('{"success": false, "message": "Could not update status. Please try again later."}');
}
