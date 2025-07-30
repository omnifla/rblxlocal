<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Game\ClientScriptCreator;
use Roblox\Game\ClientHelper;
ClientHelper::init();
$rawScript = ClientScriptCreator::getScript('join', ClientScriptCreator::$DEFAULT_REPLACELIST);
$signedScript = ClientHelper::signTextBlob($rawScript);
exit($signedScript);
