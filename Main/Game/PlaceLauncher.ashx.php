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
// Source - https://stackoverflow.com/a
// Posted by Ben, modified by community. See post 'Timeline' for change history
// Retrieved 2025-11-23, License - CC BY-SA 3.0

$realIP = file_get_contents("http://ipecho.net/plain"); // unethical for now.

// output
$output = [
    "jobId" => $jobId,
    "status" => $status,
    "joinScriptUrl" => $joinscriptURL . "?placeId={$placeId}&jobId={$placeId}&MachineAddress={$realIP}",
    "authenticationUrl" => $authenticationURL . "?suggest={$cookie}",
    "authenticationTicket" => (string)$cookie,
    "message" => "Joining Server..."
];
exit(json_encode($output));
?>