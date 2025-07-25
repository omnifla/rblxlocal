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

$cooldownSeconds = 10;

$sql = "
    INSERT INTO feeds (author_id, content, posted_at)
    SELECT :user_id, :status, NOW()
    FROM dual
    WHERE NOT EXISTS (
        SELECT 1 FROM feeds
        WHERE author_id = :user_id
        AND posted_at > NOW() - INTERVAL :cooldown SECOND
    )
    LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':user_id', $user['id'], PDO::PARAM_INT);
$stmt->bindValue(':status', $status, PDO::PARAM_STR);
$stmt->bindValue(':cooldown', $cooldownSeconds, PDO::PARAM_INT);

$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo '{"success": true, "message": "Status updated successfully."}';
} else {
    echo '{"success": false, "message": "You are on a cooldown!"}';
}