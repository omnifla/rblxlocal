<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
// handle assets ig

use Roblox\Game\Asset\AssetFetcher;

if (!isset($_GET['id'])) {
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=unknown");
    exit('');
}
$id = (int) $_GET['id'];
$fetcherInstance = new AssetFetcher();

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $id);
exit($fetcherInstance->getAsset($id));