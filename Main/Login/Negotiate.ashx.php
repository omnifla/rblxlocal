<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/../config/main.php';
use Roblox\Authentication as Auth;

$ticket = $_GET["ticket"] ?? '';
$user = Auth::RedeemHandoffTicket($ticket);

if (!$user) {
    header("HTTP/1.1 403 Forbidden");
    exit("Invalid or expired ticket.");
}

$returnUrl = $_GET['returnUrl'] ?? '/Home';
if (!preg_match('#^/(?!/)#', $returnUrl)) {
    $returnUrl = '/Home';
}

header("Location: " . $returnUrl);
exit;
