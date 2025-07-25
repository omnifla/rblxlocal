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

$cooldownSeconds = 10;

$stmtCooldown = $conn->prepare("SELECT posted_at FROM feeds WHERE author_id = :user_id ORDER BY posted_at DESC LIMIT 1");
$stmtCooldown->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$stmtCooldown->execute();
$lastPostTimestamp = $stmtCooldown->fetchColumn();

if ($lastPostTimestamp !== false) {
    $lastPostTimestamp = (int)$lastPostTimestamp;
    $now = time();
    $diff = $now - $lastPostTimestamp;

    if ($diff < $cooldownSeconds) {
        echo '{"success": false, "message": "You are on a cooldown!"}';
        exit;
    }
}

$time_posted = time();

$stmt = $conn->prepare("INSERT INTO feeds (author_id, content, posted_at) VALUES (:user_id, :status, :created_at)");
$stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$stmt->bindParam(':status', $status, PDO::PARAM_STR);
$stmt->bindParam(':created_at', $time_posted, PDO::PARAM_INT);
$stmt->execute();


$filtered = $filter->filter($rawStatus)->getFilteredText();
$status = mb_substr((string) $filtered, 0, 1000, 'UTF-8');

if (mb_strlen($status, 'UTF-8') > 150) {
    echo '{"success": false, "message": "Status must be 150 characters or less."}';
    exit;
}

$time_posted = date('Y-m-d H:i:s');

$stmt = $conn->prepare("INSERT INTO feeds (author_id, content, posted_at) VALUES (:user_id, :status, :created_at)");
$stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$stmt->bindParam(':status', $status, PDO::PARAM_STR);
$stmt->bindParam(':created_at', $time_posted, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo '{"success": true, "message": "Status updated successfully."}';
} else {
    echo '{"success": false, "message": "Could not update status."}';
}

}


$filtered = $filter->filter($rawStatus)->getFilteredText();
$status = mb_substr((string) $filtered, 0, 1000, 'UTF-8');

if (mb_strlen($status, 'UTF-8') > 150) {
    echo '{"success": false, "message": "Status must be 150 characters or less."}';
    exit;
}

$time_posted = time();
$stmt = $conn->prepare("INSERT INTO feeds (author_id, content, posted_at) VALUES (:user_id, :status, :created_at)");
$stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
$stmt->bindParam(':status', $status, PDO::PARAM_STR);
$stmt->bindParam(':created_at', $time_posted, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo '{"success": true, "message": "Status updated successfully."}';
} else {
    echo '{"success": false, "message": "Could not update status."}';
}
