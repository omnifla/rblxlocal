<?php
// writen by chloe
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
$id = intval($_GET['id'] ?? 0);
$page = max(1, intval($_GET['page'] ?? 1));
$cat = isset($_GET['cat']) ? intval($_GET['cat']) : null;

if ($id <= 0) {
    http_response_code(404);
    exit;
}

$itemsPerPage = 18;
$offset = ($page - 1) * $itemsPerPage;

$db = $conn;

$catFilter = $cat !== null ? 'AND a."AssetType" = :cat' : '';

$sql = '
SELECT i."UAID", i."Timestamp", a."AssetId", a."OwnerId", a."AssetType", a."Name", a."Description",
       a."RobuxPrice", a."TixPrice", a."Offsale", a."Limited", a."LimitedUnique", a."Serials",
       a."CreationDate", a."UpdatedDate"
FROM "inventory" i
INNER JOIN "assets" a ON i."AssetId" = a."AssetId"
WHERE i."UserId" = :userId ' . $catFilter . '
ORDER BY i."Timestamp" DESC
LIMIT :limit OFFSET :offset
';

$stmt = $db->prepare($sql);
$stmt->bindValue(':userId', $id, PDO::PARAM_INT);
if ($cat !== null) {
    $stmt->bindValue(':cat', $cat, PDO::PARAM_INT);
}
$stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$assets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html style="background-color: #fff;">
<head>
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___dac4a444950639c02cc831a484c826f5_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___1b22aeedd7f4e73ab0700a149f589336_m.css">
</head>
<body>
<div id="AssetsContent">
    <div id="RepeatingUserAssetData">
        <?php if (count($assets) === 0): ?>
            <p>This user has no items in this category.</p>
        <?php else: ?>
        <table cellspacing="0" border="0" style="border-collapse:collapse;">
            <tbody>

            <?php
            $cols = 6;
            $rows = 3;
            $total = count($assets);
            
            $ownerIds = array_map(function($a) { return (int)$a['OwnerId']; }, $assets);
            $ownerIds = array_unique($ownerIds);
            $placeholders = implode(',', array_fill(0, count($ownerIds), '?'));
            
            $stmt = $db->prepare("SELECT id, username FROM users WHERE id IN ($placeholders)");
            $stmt->execute($ownerIds);
            $usernames = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
            
            for ($r = 0; $r < $rows; $r++) {
                echo "<tr>";
                for ($c = 0; $c < $cols; $c++) {
                    $index = $r * $cols + $c;
                    if ($index >= $total) {
                        echo "<td class='Asset'></td>";
                        continue;
                    }
            
                    $a = $assets[$index];
                    $imgSrc = "/Asset/Thumbs/{$a['AssetId']}.png";
                    $nameEscaped = htmlspecialchars($a['Name']);
                    $descEscaped = htmlspecialchars($a['Description'] ?? '');
                    $ownerId = (int)$a['OwnerId'];
                    $assetId = (int)$a['AssetId'];
                    $creatorName = isset($usernames[$ownerId]) ? htmlspecialchars($usernames[$ownerId]) : "User {$ownerId}";
            
                    $limitedIcon = "";
                    $serialDiv = "";
            
                    if ($a['LimitedUnique']) {
                        $limitedIcon = '<div style="position:relative;left:-22px;top:-13px;"><img src="/images/assetIcons/limitedunique.png"></div>';
                        $serialDiv = '<div style="position:relative;text-align:center;width:95px;font-size:10px;left:0px;top:-124px;font-weight:bold;color:#003366">#' . ($a['Serials'] > 0 ? $a['Serials'] : 'N/A') . ' / ' . ($a['Serials'] > 0 ? $a['Serials'] : 'N/A') . '</div>';
                    } elseif ($a['Limited']) {
                        $limitedIcon = '<div style="position:relative;left:-22px;top:-13px;"><img src="/images/assetIcons/limited.png"></div>';
                    }
            
                    echo "<td class='Asset' valign='top'>
                        <div style='padding: 5px'>
                            <div class='AssetThumbnail'>
                                <a class='notranslate' title='{$nameEscaped}' href='/Item?id={$assetId}' style='display:inline-block;height:110px;width:110px;cursor:pointer;'>
                                    <img src='/Images/Placeholder1024x1024.png' height='110' width='110' border='0' alt='{$nameEscaped}' class='notranslate' onerror='return Roblox.Controls.Image.OnError(this)'>
                                </a>
                                {$limitedIcon}
                                {$serialDiv}
                            </div>
                            <div class='AssetDetails'>
                                <div class='AssetName'>
                                    <a class='noranslate' href='/Item?id={$assetId}'>{$nameEscaped}</a>
                                </div>
                                <div class='AssetCreator'>
                                    <span class='Label'>Creator: </span>
                                    <span class='Detail notranslate'>
                                        <a href='/User.aspx?ID={$ownerId}'>{$creatorName}</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </td>";
                }
                echo "</tr>";
            }
            ?>

            </tbody>
        </table>

        <div id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPagerPanel" class="FooterPager" style="width: 780px; display: flex; justify-content: center; align-items: center; gap: 5px;">
            <?php if ($page > 1): ?>
                <a href="javascript:void(0)" onclick="changePage(<?php echo $page - 1 ?>)"><span class="pager previous"></span></a>
            <?php else: ?>
                <span class="pager previous disabled"></span>
            <?php endif; ?>
            <span id="ctl00_cphRoblox_rbxUserAssetsPane_FooterPagerLabel" style="vertical-align: top; display: inline-block; padding: 5px; padding-top: 6px">
                Page <?php echo $page ?>
            </span>
            <?php if ($total === $itemsPerPage): ?>
                <a href="javascript:void(0)" onclick="changePage(<?php echo $page + 1 ?>)"><span class="pager next"></span></a>
            <?php else: ?>
                <span class="pager next disabled"></span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
function changePage(newPage) {
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('id') || 1;
    const cat = urlParams.get('cat') || 0;
    window.location.href = `/Users/Inventory.php?id=${userId}&page=${newPage}&cat=${cat}`;
}
</script>
</body>
</html>
