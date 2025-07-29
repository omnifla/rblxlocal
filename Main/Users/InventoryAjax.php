<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
session_start();

$id = intval($_GET['id'] ?? 0);
$page = max(1, intval($_GET['page'] ?? 1));
$cat = isset($_GET['cat']) ? intval($_GET['cat']) : null;

if ($id <= 0) {
    http_response_code(404);
    exit;
}

$currentUserPrivacy = null;
if (isset($_SESSION['id'])) {
    $stmt = $conn->prepare('SELECT "InventoryPrivacy" FROM users WHERE id = :id');
    $stmt->execute([':id' => $_SESSION['id']]);
    $currentUserPrivacy = $stmt->fetchColumn();
}

$canViewInventory = ($currentUserPrivacy === 'All');

if (!$canViewInventory) {
    echo '<p>You cannot view this user\'s inventory.</p>';
    exit;
}

$itemsPerPage = 18;
$offset = ($page - 1) * $itemsPerPage;

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

$stmt = $conn->prepare($sql);
$stmt->bindValue(':userId', $id, PDO::PARAM_INT);
if ($cat !== null) {
    $stmt->bindValue(':cat', $cat, PDO::PARAM_INT);
}
$stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$assets = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($assets) === 0) {
    echo '<p>This user has no items in this category.</p>';
    exit;
}

$ownerIds = array_unique(array_map(fn($a) => (int)$a['OwnerId'], $assets));
if (count($ownerIds) > 0) {
    $placeholders = implode(',', array_fill(0, count($ownerIds), '?'));
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE id IN ($placeholders)");
    $stmt->execute($ownerIds);
    $usernames = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
} else {
    $usernames = [];
}

$cols = 6;
$rows = 3;
$total = count($assets);

echo '<table cellspacing="0" border="0" style="border-collapse:collapse;"><tbody>';

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
                        <img src='{$imgSrc}' height='110' width='110' border='0' alt='{$nameEscaped}' class='notranslate' onerror='return Roblox.Controls.Image.OnError(this)'>
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
echo "</tbody></table>";

echo '<div class="FooterPager" style="width: 780px; display: flex; justify-content: center; align-items: center; gap: 5px; margin-top: 15px;">';
if ($page > 1) {
    echo '<span class="pager previous" data-page="' . ($page - 1) . '"></span>';
} else {
    echo '<span class="pager previous disabled"></span>';
}
echo '<span style="vertical-align: top; display: inline-block; padding: 5px; padding-top: 6px">Page ' . $page . '</span>';
if ($total === $itemsPerPage) {
    echo '<span class="pager next" data-page="' . ($page + 1) . '"></span>';
} else {
    echo '<span class="pager next disabled"></span>';
}
echo '</div>';
?>
