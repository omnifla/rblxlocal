<?php
header("Content-Type: application/xml"); 
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\BrickColor;
use Roblox\Authentication as Auth;

$uid = $_GET['userId'] ?? $_GET['UserId'] ?? 1;
$user = Auth::GetUserInfo(intval($uid));
$bodycolor = json_decode($user['bodycolor'], true);
//{"HeadColor": 1, "TorsoColor": 23, "LeftArmColor": 1, "LeftLegColor": 11, "RightArmColor": 1, "RightLegColor": 11}
?>
<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
<External>null</External>
<External>nil</External>
<Item class="BodyColors">
<Properties>
<int name="HeadColor"><?= $bodycolor['HeadColor'] ?></int>
<int name="LeftArmColor"><?= $bodycolor['LeftArmColor'] ?></int>
<int name="LeftLegColor"><?= $bodycolor['LeftLegColor'] ?></int>
<string name="Name">Body Colors</string>
<int name="RightArmColor"><?= $bodycolor['RightArmColor'] ?></int>
<int name="RightLegColor"><?= $bodycolor['RightLegColor'] ?></int>
<int name="TorsoColor"><?= $bodycolor['TorsoColor'] ?></int>
<bool name="archivable">true</bool>
</Properties>
</Item>
</roblox>