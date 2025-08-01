<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Game\ClientScriptCreator;

header('Content-Type: text/plain');
exit(ClientScriptCreator::getScript('rcc-player', [
    '{0}' => 'PNG', // thumbnail click ext
    '{1}' => 'true', // thumbnail click hideSky
    '{2}' => 'true', // use legacy rendering (set this true for 2014M-ish renders)
    '{3}' => $_ENV['SITE_DOMAIN'], // site, just use .env

    // player render
    '{4}' => 'http://rblx.local/Asset/CharacterFetch.ashx?userId=1', // character appearance
    '{5}' => '2560', // height
    '{6}' => '1440', // width
]));