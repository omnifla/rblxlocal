<?php
// written by meditext
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\EconomyHelper;
use Roblox\Economy\Common\UserBalance;
use Roblox\Economy\Product;
use Roblox\Economy\RobloxProduct;
header("Content-Type: application/json");
// {"success": bool, "title": string, "message": string, "remainingBalance": int}
$authenticatedUser = Auth::GetAuthenticatedUserInfo();
if(!$authenticatedUser) {
    http_response_code(401);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Not authenticated', 'remainingBalance' => 0]));
}
$e = new UserBalance($authenticatedUser['id']);
$robux = $e->GetRobuxBalance();
$remainingBalance = $robux - 1000; // pre-calculate remaining balance if username change is successful
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(200);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Invalid request method', 'remainingBalance' => $robux]));
}
if(!isset($_POST['username']) || !isset($_POST['password'])) {
    http_response_code(200);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Invalid parameters', 'remainingBalance' => $robux]));
}
$check1 = Auth::VerifyPassword($authenticatedUser, $_POST['password']);
if(!$check1) {
    http_response_code(200);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Invalid password', 'remainingBalance' => $robux]));
};
$newUsername = trim($_POST['username']);
try {
    Auth::ValidateUsername($newUsername);
} catch(Exception $e) {
    http_response_code(200);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => $e->getMessage(), 'remainingBalance' => $robux]));
}
if($authenticatedUser['robux'] <= 1000 || $remainingBalance < 0) {
    http_response_code(200);
    $robux_left = 1000 - $authenticatedUser['robux'];
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => "Insufficient ROBUX for changing your username, you need R$ {$robux_left} more to change your username. Try again later", 'remainingBalance' => $robux]));
}
$username_change = Product::GetById(1);
if(!$username_change) {
    http_response_code(200);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Failed to change username, please try again later', 'remainingBalance' => $robux]));
}
$username_change_rb_product = RobloxProduct::GetById($username_change->RobloxProductID);
if(!$username_change_rb_product) {
    http_response_code(200);
    exit(json_encode(['success' => false, 'title' => 'Error', 'message' => 'Failed to change username, please try again later', 'remainingBalance' => $robux]));
}
EconomyHelper::conductRobloxProductSaleByAuction($authenticatedUser['id'], 1, 1, $username_change->PriceInRobux);
$change = $conn->prepare("UPDATE users SET username = :username WHERE id = :id");
$change->execute([':username' => $newUsername, ':id' => $authenticatedUser['id']]);
exit(json_encode(['success' => true, 'remainingBalance' => $remainingBalance]));