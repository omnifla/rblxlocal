<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Game\ClientScriptCreator;
header("content-type: text/plain");
ob_start();
?>
<?= ClientScriptCreator::getScript('visit', ClientScriptCreator::$DEFAULT_REPLACELIST); ?>
<?php
$data = ob_get_clean();
echo $data;
?>