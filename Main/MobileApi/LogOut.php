<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
header('Content-Type: application/json');
Roblox\Authentication::LogOut();
exit('{"success": true}');