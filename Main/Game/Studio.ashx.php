<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Game\ClientScriptCreator;

exit(ClientScriptCreator::getScript('studio', ClientScriptCreator::$DEFAULT_REPLACELIST));