<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\TextFilter\BasicTextFilter;

header("Content-Type: application/json");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$filter = new BasicTextFilter();
$rawStatus = $_POST['status'] ?? null;

if (!Auth::GetAuthenticatedUser()) {
    echo json_encode(["success" => false, "message" => "You must be logged in to update your status."]);
    exit;
}

$user = Auth::GetAuthenticatedUserInfo();

if ($rawStatus === null || trim($rawStatus) === '') {
    echo json_encode(["success" => false, "message" => "Status cannot be empty."]);
    exit;
}

$filteredText = (string) $filter->filter($rawStatus)->getFilteredText();
$trimmedStatus = trim($filteredText);

if (mb_strlen($trimmedStatus, 'UTF-8') > 150) {
    echo json_encode(["success" => false, "message" => "Status must be 150 characters or less."]);
    exit;
}

$time_posted = time();
$stmt = $conn->prepare("INSERT INTO feeds (author_id, content, posted_at) VALUES (:user_id, :status, :created_at)");
$stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$stmt->bindParam(':status', $trimmedStatus, PDO::PARAM_STR);
$stmt->bindParam(':created_at', $time_posted, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Status updated successfully."]);
} else { 
    echo json_encode(["success" => false, "message" => "Could not update status."]); // I CANT MAKE THE FILTER TO WORK SOME PLEASE HELP
}
