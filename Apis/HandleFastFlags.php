<?php
// written by meditext
// this is a routing system for /Settings/QuietGet
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Game\LegacyFFlagDeployer as FFlag;
// get the path from url (/Settings/QuietGet/PathHere)
$path = isset($_GET['path']) ? trim($_GET['path'], ' \n\r\t\v\0/') : 'ClientAppSettings';
// load the clientsettings
$fflag = new FFlag();
$fflag->handleRequest($path);