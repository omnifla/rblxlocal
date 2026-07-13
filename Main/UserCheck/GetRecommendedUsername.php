<?php
// written by meditext
// we are going to make random suggestions for usernames if they're taken or not:
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
$tryuser = $_GET['usernameToTry'];
exit($tryuser.rand(100, 9999));