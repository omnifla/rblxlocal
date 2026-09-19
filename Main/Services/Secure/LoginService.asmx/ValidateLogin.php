<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://roblox.local');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
header('Access-Control-Allow-Methods: POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(json_encode(["d" => ["IsValid" => false, "ErrorCode" => "3", "Message" => "Preflight OK"]]));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit(json_encode(["d" => ["IsValid" => false, "ErrorCode" => "3", "Message" => "Invalid request method"]]));
}

$rawBody = file_get_contents('php://input');
$input = json_decode($rawBody, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    parse_str($rawBody, $input);
}

$username = trim((string) ($input['userName'] ?? $input['username'] ?? ''));
$password = (string) ($input['password'] ?? '');

if ($username === '' || $password === '') {
    exit(json_encode(["d" => [
        "IsValid" => false,
        "ErrorCode" => "1",
        "Message" => "Username and password are required."
    ]]));
}

try {
    $user = Auth::Login($username, $password);
    $result = [
        "IsValid" => true,
        "ErrorCode" => "0",
        "Message" => "",
        "UserInfo" => [
            "UserID" => $user['id'],
            "UserName" => $user['username'],
            "ThumbnailUrl" => ($site_properties['baseUrl'] ?? '') . "/Thumbs/Avatar.ashx?userId=" . $user['id']
        ]
    ];
} catch (\InvalidArgumentException $e) {
    $result = [
        "IsValid" => false,
        "ErrorCode" => "7",
        "Message" => $e->getMessage()
    ];
} catch (\Exception $e) {
    $result = [
        "IsValid" => false,
        "ErrorCode" => "3",
        "Message" => "An error occurred while processing login."
    ];
}

exit(json_encode(["d" => $result]));
