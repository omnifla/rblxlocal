<?php
// written by meditext
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
header("Content-Type: application/json");
// {"success": bool, "title": string, "message": string, "remainingBalance": int}
$authenticatedUser = Auth::GetAuthenticatedUserInfo();
if(!$authenticatedUser) {
    http_response_code(401);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Not authenticated', 'remainingBalance' => 0]));
}
$remainingBalance = $authenticatedUser['robux'] - 1000; // pre-calculate remaining balance if username change is successful
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Invalid request method', 'remainingBalance' => $authenticatedUser['robux']]));
}
if(!isset($_POST['username']) || !isset($_POST['password'])) {
    http_response_code(400);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Invalid parameters', 'remainingBalance' => $authenticatedUser['robux']]));
}
$check1 = Auth::VerifyPassword($authenticatedUser, $_POST['password']);
if(!$check1) {
    http_response_code(403);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Invalid password', 'remainingBalance' => $authenticatedUser['robux']]));
};
$newUsername = trim($_POST['username']);
try {
    Auth::ValidateUsername($newUsername);
} catch(Exception $e) {
    http_response_code(400);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => $e->getMessage(), 'remainingBalance' => $authenticatedUser['robux']]));
}
if($authenticatedUser['robux'] <= 1000 || $remainingBalance < 0) {
    http_response_code(403);
    $robux_left = 1000 - $authenticatedUser['robux'];
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => "Insufficient ROBUX for changing your username, you need R$ {$robux_left} more to change your username. Try again later", 'remainingBalance' => $authenticatedUser['robux']]));
}
$changeUsername_stmt = $conn->prepare("UPDATE users SET username = :username, robux = :robux updated = NOW() WHERE id = :id");
$changeUsername_stmt->execute([
    ':username' => $newUsername,
    ':robux' => $remainingBalance,
    ':id' => $authenticatedUser['id']
]);
$rel = htmlspecialchars($authenticatedUser['user']);
exit(json_encode(['success' => true, 'title' => 'Success', 'message' => "Username changed successfully from <b>{$rel}</b> to {htmlspecialchars($newUsername)}", 'remainingBalance' => $remainingBalance]));