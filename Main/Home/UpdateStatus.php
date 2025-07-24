<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\TextFilter\BasicTextFilter;

header("Content-Type: application/json");

// Connexion sécurisée PDO avec erreurs activées
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$filter = new BasicTextFilter();
$status = $_POST['status'] ?? null;

if (!Auth::GetAuthenticatedUser()) {
    echo json_encode(["success" => false, "message" => "You must be logged in to update your status."]);
    exit;
}

$user = Auth::GetAuthenticatedUserInfo();

if ($status === null || trim($status) === '') {
    echo json_encode(["success" => false, "message" => "Status cannot be empty."]);
    exit;
}

$filtered = $filter->filter($status)->getFilteredText();
$filtered = (string)$filtered;

if (mb_strlen($filtered, 'UTF-8') > 280) {
    echo json_encode(["success" => false, "message" => "Status must be 280 characters or less."]);
    exit;
}

try {
    $time_posted = time();
    $stmt = $conn->prepare("INSERT INTO feeds (author_id, content, posted_at) VALUES (:user_id, :status, :created_at)");
    $stmt->bindParam(':user_id', $user['id'], PDO::PARAM_INT);
    $stmt->bindParam(':status', $filtered, PDO::PARAM_STR);
    $stmt->bindParam(':created_at', $time_posted, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Status updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Database error."]);
    }
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Exception: " . $e->getMessage()]);
}
