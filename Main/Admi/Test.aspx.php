<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use UserControls\Admi\Header;
use UserControls\Admi\Footer;

$authUser = Auth::GetAuthenticatedUserInfo();
if (!$authUser || (int)$authUser['id'] !== 1) { header('Location: /'); exit; }

$userId = (int)($_GET['ID'] ?? 1);

// user info
$userStmt = $conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
$userStmt->execute([':id' => $userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// asset types
$atStmt = $conn->query("SELECT DISTINCT \"AssetType\" as id, COUNT(*) as count FROM assets GROUP BY \"AssetType\" ORDER BY \"AssetType\"");
$assetTypes = $atStmt->fetchAll(PDO::FETCH_ASSOC);

function renderGrid(array $rows, string $empty): string {
    if (empty($rows)) return '<p style="color:#999;">' . htmlspecialchars($empty) . '</p>';
    $html = '<table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse;font-size:11px;background:#EFF3FB;">';
    $html .= '<tr style="background:#507CD1;color:#fff;font-weight:bold;">';
    foreach (array_keys($rows[0]) as $col) $html .= '<th>' . htmlspecialchars($col) . '</th>';
    $html .= '</tr>';
    foreach ($rows as $i => $row) {
        $bg = $i % 2 === 0 ? '#EFF3FB' : '#fff';
        $html .= '<tr style="background:' . $bg . ';">';
        foreach ($row as $v) $html .= '<td>' . htmlspecialchars((string)$v) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    return $html;
}

echo Header::render();
?>
<h1>WebForms Test Page</h1>
<div style="background:#fff;padding:10px;border:1px solid #ccc;margin-bottom:12px;">
    <h3>Platform IUser Test (ID: <?= $userId ?>)</h3>
    <?= renderGrid($user ? [array_diff_key($user, array_flip(['password', 'ips']))] : [], 'The specified user does not exist') ?>

    <h3>Platform IRoleSet Test</h3>
    <?php
    $roleStmt = $conn->prepare("SELECT membership_type as role_id, CASE membership_type WHEN 0 THEN 'None' WHEN 1 THEN 'BC' WHEN 2 THEN 'TBC' WHEN 3 THEN 'OBC' END as role_name FROM users WHERE id = :id LIMIT 1");
    $roleStmt->execute([':id' => $userId]);
    $roles = $roleStmt->fetchAll(PDO::FETCH_ASSOC);
    echo renderGrid($roles, 'The specified account ID has no associated roles');
    ?>

    <h3>Platform IEmailAddress Test</h3>
    <?php
    $emailStmt = $conn->prepare("SELECT email FROM users WHERE id = :id AND email IS NOT NULL LIMIT 1");
    $emailStmt->execute([':id' => $userId]);
    $emails = $emailStmt->fetchAll(PDO::FETCH_ASSOC);
    echo renderGrid($emails, 'The specified account ID has no associated email address');
    ?>

    <h3>AssetType Test</h3>
    <?= renderGrid($assetTypes, 'No AssetTypes found') ?>
</div>
<?= Footer::render() ?>