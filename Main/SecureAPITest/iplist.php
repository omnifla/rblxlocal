<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Web\SecureAPI;
use Roblox\Game\ClientScriptCreator;
use Roblox\Game\Asset\AssetFetcher;

$myKey = new SecureAPI\IPList(['::1', '127.0.0.1'], false);
if ($myKey->processRequest() == $myKey::NO_IPGIVEN)
    exit('failure noip');
if ($myKey->processRequest() == $myKey::INVAILD)
    exit('failure');

//exit(ClientScriptCreator::getScript('visit', ClientScriptCreator::$DEFAULT_REPLACELIST));
$fetcherInstance = new AssetFetcher();
exit($fetcherInstance->getAsset('1818'));