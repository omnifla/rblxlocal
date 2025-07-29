<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use \Roblox\Database;

$username = $_GET['username'] ?? '';
$size = $_GET['size'] ?? '';
$db = Database::get();

$placeholder = '/Images/Spacer.png';
$validSizes = ['small', '', 'big'];
$membershipNames = [
    1 => 'bcOnly',
    2 => 'tbcOnly',
    3 => 'obcOnly'
];

if (!preg_match('/^[a-zA-Z0-9_]{3,}$/', $username) || !in_array($size, $validSizes)) {
    $src = $placeholder;
} else {
    $stmt = $db->prepare("SELECT membership_type FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && isset($membershipNames[$user['membership_type']])) {
        $suffix = $size !== '' ? "_$size" : '';
        $src = "/Images/Overlays/overlay_" . $membershipNames[$user['membership_type']] . $suffix . ".png";
    } else {
        $src = $placeholder;
    }
}

header('Content-Type: image/png');
readfile($_SERVER['DOCUMENT_ROOT'] . $src);
?>
