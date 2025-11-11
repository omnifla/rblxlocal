<?php
// written by meditext
// this is responsible for returning allowed clients versions, so the RCC can authorize the whitelisted client
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
header('Content-Type: application/json');
$data = [];
$all_clients = $conn->query("SELECT release_version, release_type FROM clients");
while ($row = $all_clients->fetch_assoc()) {
    $data[] = $row['release_version'].$row['release_type']; // output: 0.123.0clienttype
}
exit(json_encode(["data" => $data]));