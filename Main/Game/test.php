<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
// basic api for getting player rcc renders
// only meant for localhost, so DO NOT GET THIS WORKING ON THE OFFICIAL SITE

use Roblox\Game\ClientScriptCreator;
use Roblox\Grid\Common\GridServiceUtils;
use Roblox\Grid\Rcc;
use Roblox\Web\SecureAPI\IPList;

function getGUID() {
    if (function_exists('com_create_guid'))
        return com_create_guid();
    else
        return 'nocomguid';
}

header('Content-Type: text/plain');
$ipListInstance = new IPList(['::1', '127.0.0.1'], false);
if ($ipListInstance->processRequest() == $ipListInstance::NO_IPGIVEN)
    exit('');
if ($ipListInstance->processRequest() == $ipListInstance::INVAILD)
    exit('');

$rccInstance = GridServiceUtils::GetService('127.0.0.1', 64989);
// $rccScript = ClientScriptCreator::getScript('rcc-player', [
//     '{0}' => 'PNG', // thumbnail click ext
//     '{1}' => 'true', // thumbnail click hideSky
//     '{2}' => 'true', // use legacy rendering (set this true for 2014M-ish renders)
//     '{3}' => $_ENV['SITE_DOMAIN'], // site, just use .env

//     // player render
//     '{4}' => 'http://rblx.local/Asset/CharacterFetch.ashx?userId=1', // character appearance
//     '{5}' => '512', // height
//     '{6}' => '512', // width
// ]);
$rccScript = ClientScriptCreator::getScript('rcc-place');
$baseUrl = 'http://' . $_ENV['SITE_DOMAIN'] . '/'; // weird quirk, we have to do this
$jobID = getGUID();

// check if RCC is online, if not, then give up :pray:
if (!$rccInstance->HelloWorld())
    exit('RCC is not online.');

$job = new Rcc\Job($jobID);
$scriptInstance = new Rcc\ScriptExecution($jobID . '-Script', $rccScript, ['1820', $baseUrl, 'PNG', '1920', '1080']);
$jobResult = $rccInstance->BatchJob($job, $scriptInstance);

if (isset($jobResult[0]))
    exit($jobResult[0]);
else
    exit('Invalid thumbnail generation');