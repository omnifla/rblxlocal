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

$ipListInstance = new IPList(['::1', '127.0.0.1'], false);
if ($ipListInstance->processRequest() == $ipListInstance::NO_IPGIVEN)
    exit('');
if ($ipListInstance->processRequest() == $ipListInstance::INVAILD)
    exit('');

$rccInstance = GridServiceUtils::GetService('127.0.0.1', 64989);
$rccScript = ClientScriptCreator::getScript('rcc-player', [
    '{0}' => 'PNG', // thumbnail click ext
    '{1}' => 'true', // thumbnail click hideSky
    '{2}' => 'true', // use legacy rendering (set this true for 2014M-ish renders)
    '{3}' => $_ENV['SITE_DOMAIN'], // site, just use .env

    // player render
    '{4}' => 'http://rblx.local/Asset/CharacterFetch.ashx?userId=1', // character appearance
    '{5}' => '2560', // height
    '{6}' => '1440', // width
]);
$jobID = getGUID();

$job = new Rcc\Job($jobID);
$scriptInstance = new Rcc\ScriptExecution($jobID . '-Script', $rccScript);
$jobResult = $rccInstance->BatchJob($job, $scriptInstance);

echo $jobResult[0];