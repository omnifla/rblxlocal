<?php
// written by meditext
require_once $_SERVER['DOCUMENT_ROOT'] . "/../config/main.php";
// response:
/*
    {
        "jobId": "string",
        "status": int,
        "joinScriptUrl": "string",
        "authenticationUrl": "string",
        "authenticationTicket": "string",
        "message": "string"
    }
*/
// status:
/* 
    1: waiting for server
    2: Server Found, Joining
*/
// urls
$joinscriptURL = $site_properties['baseUrl'] . "/Game/Join.ashx";
$authenticationURL = $site_properties['baseUrl'] . "/Login/Negotiate.ashx";
// vars
$placeId = $_GET['placeId'];
$jobId = $_GET['jobId'] ?? "Test";
$cookie = $_COOKIE['_ROBLOSECURITY'] ?? 0; // maybe i should look more on the code for tickets
$status = 2; // temporary
$request = $_GET['request'] ?? "JoiningServer";
$isPlayTogetherGame = $_GET['isPlayTogetherGame'] ?? false;

// output
$output = [
    "jobId" => $jobId,
    "status" => $status,
    "joinScriptUrl" => $joinscriptURL . "?placeId={$placeId}&jobId={$placeId}&MachineAddress=capital-tile.gl.at.ply.gg&serverPort=47683",
    "authenticationUrl" => $authenticationURL . "?suggest={$cookie}",
    "authenticationTicket" => (string)$cookie,
    "message" => "Joining Server..."
];
exit(json_encode($output));
?>