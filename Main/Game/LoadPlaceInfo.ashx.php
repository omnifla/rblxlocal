<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Game\ClientScriptCreator;
header("Content-Type: text/plain");
exit(ClientScriptCreator::getScript('place-info', ClientScriptCreator::$DEFAULT_REPLACELIST));