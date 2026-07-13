<?php
// written by meditext
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
header("content-type: application/json");
$id = isset($_GET['userId']) ? intval($_GET['userId']) : null;

    $url = $site_properties['baseUrl']."/avatar-thumbnail-3d/?userId=" . $id;

    $json = [
        "Url" => $url,
        "Final" => true
    ];

    die(json_encode($json, JSON_UNESCAPED_SLASHES));
?>
