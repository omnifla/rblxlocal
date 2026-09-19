<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

use Roblox\Authentication as Auth;

header('Content-Type: application/json');

$user = Auth::GetAuthenticatedUser();
if (!$user) {
    http_response_code(401);
    exit(json_encode([
        'Status' => 'Error',
        'Message' => 'Not authenticated',
    ]));
}

global $conn;
$stmt = $conn->prepare('SELECT birthdate, email FROM users WHERE id = :id LIMIT 1');
$stmt->execute([':id' => (int) $user['id']]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$birthdate = $row['birthdate'] ?? null;
$email = trim((string) ($row['email'] ?? ''));
$ageBracket = 1;

if (!empty($birthdate)) {
    try {
        $birth = new DateTime($birthdate);
        $today = new DateTime('today');
        $age = (int) $today->diff($birth)->y;
        $ageBracket = $age >= 13 ? 2 : 1;
    } catch (Exception $e) {
        $ageBracket = 1;
    }
}

$siteBaseUrl = rtrim((string) ($site_properties['baseUrl'] ?? ''), '/');

exit(json_encode([
    'Status' => 'OK',
    'AgeBracket' => $ageBracket,
    'UserEmail' => $email !== '' ? $email : null,
]));
