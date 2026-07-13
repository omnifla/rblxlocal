<?php
// written by meditext
// this is responsible for returning allowed MD5 hashes, so the RCC can authorize the whitelisted client
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
header('Content-Type: application/json');
$data = [];
$all_clients = $conn->query("SELECT * FROM \"clients\"");
$rows = $all_clients->fetchAll();
foreach($rows as $row) {
    $data[] = $row['binary_checksum'];
}
exit(json_encode(["data" => $data]));