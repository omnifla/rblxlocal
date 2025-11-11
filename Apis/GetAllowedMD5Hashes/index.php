<?php
// written by meditext
// this is responsible for returning allowed MD5 hashes, so the RCC can authorize the whitelisted client
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
header('Content-Type: application/json');
$data = [];
$all_clients = $conn->query("SELECT binary_checksum FROM clients");
while ($row = $all_clients->fetch_assoc()) {
    $data[] = $row['binary_checksum'];
}
exit(json_encode(["data" => $data]));