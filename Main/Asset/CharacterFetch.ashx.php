<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Accoutrement;
//header('Content-Type: text/plain');
$user_id = isset($_GET['userId']) ? (int)$_GET['userId'] : 1;
$place_id = isset($_GET['placeId']) ? (int)$_GET['placeId'] : 0;
$equippedGearId = 0;
$assetIds = [];
$accoutrements = Accoutrement::getUserAccoutrements($user_id);
// init
$str = "http://{$site_properties['hostname']}/Asset/BodyColors.ashx?userId={$user_id};";
// get accoutrements
foreach ($accoutrements as $accoutrement) {
    $assetIds[] = $accoutrement->getDAL()->user_asset_id;
    $str .= "http://{$site_properties['hostname']}/Asset?id=".$accoutrement->getDAL()->user_asset_id . ";";
    if ($accoutrement->isEquipped()) {
        $equippedGearId = $accoutrement->getDAL()->user_asset_id;
    }
}
exit($str);
?>