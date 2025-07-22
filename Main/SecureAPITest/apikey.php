<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Web\SecureAPI;

$myKey = new SecureAPI\APIKey('test');
if ($myKey->processRequest() == $myKey::INVAILD)
    exit('failure');

exit('success!');