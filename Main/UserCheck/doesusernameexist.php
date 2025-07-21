<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/miscfunctions.php';
header("Content-Type: application/json");
$username = $_GET["username"];
// Securely prepare the SQL query
$FindUser = $pdo->prepare('SELECT * FROM users WHERE Username = :username');
$FindUser->execute(['username' => htmlspecialchars($username)]);
$row = $FindUser->fetch(PDO::FETCH_ASSOC);

// Check if the row was retrieved
if ($row) {
   exit('{"success": true}');
}
exit('{"success": false}');
?>
