<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
// handler for quiet get and that stuff

use Roblox\Game\FFlagDeployer;

$localInstance = new FFlagDeployer();
$localInstance->handleRequest();