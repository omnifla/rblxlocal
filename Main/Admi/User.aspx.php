<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Moderation\Punishment;
use Roblox\Moderation\PunishmentType;
use UserControls\Admi\Header;
use UserControls\Admi\Footer;

$authUser = Auth::GetAuthenticatedUserInfo();
if (!$authUser || (int)$authUser['id'] !== 1) { header('Location: /'); exit; }

$userId = (int)($_GET['ID'] ?? 0);
$view   = $_GET['view'] ?? 'details';

if (!$userId) { echo Header::render() . '<p>No user ID specified.</p>' . Footer::render(); exit; }

$userStmt = $conn->prepare('SELECT id, username, email, description, account_status_id, membership_type, moderation_status, lastactive, robux, tickets, wipeouts, knockouts, "InventoryPrivacy", post_count, birthdate, gender, language, created, updated FROM users WHERE id = :id LIMIT 1');
$userStmt->execute(['id' => $userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

if (!$user) { echo Header::render() . '<p>User not found.</p>' . Footer::render(); exit; }

// handle punishment submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['punishment_type'])) {
    $typeId = (int)$_POST['punishment_type'];
    $reason = trim($_POST['reason'] ?? '');
    if ($typeId > 0) {
        Punishment::create($userId, $typeId, $reason ?: null);
        header('Location: /Admi/User.aspx?ID=' . $userId . '&view=actions');
        exit;
    }
}

// fetch punishments
$punStmt = $conn->prepare("
    SELECT p.id, p.punishment_type, p.reason, p.start_date, p.end_date, p.active
    FROM punishments p
    WHERE p.user_id = :uid
    ORDER BY p.id DESC
");
$punStmt->execute([':uid' => $userId]);
$punishments = $punStmt->fetchAll(PDO::FETCH_ASSOC);

echo Header::render();
?>

<div>
    <br>
    User's <a href="/User.aspx?ID=<?= $userId ?>">home page</a><br><br>

    <div style="display:flex;gap:0;margin-bottom:10px;">
        <a href="?ID=<?= $userId ?>&view=details"
           style="padding:6px 14px;background:<?= $view==='details'?'#FFCC66':'#FFFBD6' ?>;color:#900;border:1px solid #ccc;text-decoration:none;font-family:Verdana;font-size:12px;">Details</a>
        <a href="?ID=<?= $userId ?>&view=actions"
           style="padding:6px 14px;background:<?= $view==='actions'?'#FFCC66':'#FFFBD6' ?>;color:#900;border:1px solid #ccc;text-decoration:none;font-family:Verdana;font-size:12px;">Actions</a>
    </div>

    <?php if ($view === 'details'): ?>
        <table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse;font-size:11px;">
            <tr style="background:#507CD1;color:#fff;font-weight:bold;"><th>Field</th><th>Value</th></tr>
            <?php foreach ($user as $k => $v):
                if (in_array($k, ['password'])) continue; ?>
            <tr style="background:#EFF3FB;">
                <td><?= htmlspecialchars($k) ?></td>
                <td><?= htmlspecialchars((string)($v ?? '')) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

    <?php elseif ($view === 'actions'): ?>
        <form method="post">
            <p><strong>Account State Override:</strong></p>
            <?php foreach (PunishmentType::$types as $id => $name): ?>
            <label>
                <input type="radio" name="punishment_type" value="<?= $id ?>">
                <?= htmlspecialchars($name) ?>
            </label><br>
            <?php endforeach; ?>
            <br>
            <p>Moderator Note: <input type="text" name="reason" style="width:300px;"></p>
            <button type="submit">Submit</button>
        </form>
        <br>

        <strong>Punishment History:</strong><br><br>
        <?php if (empty($punishments)): ?>
            <p>There are no punishments against this user.</p>
        <?php else: ?>
        <table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse;font-size:11px;">
            <tr style="background:#507CD1;color:#fff;font-weight:bold;">
                <th>ID</th><th>Punishment Type</th><th>Reason</th><th>Start Date</th><th>End Date</th><th>Active</th>
            </tr>
            <?php foreach ($punishments as $i => $p):
                $bg = $i % 2 === 0 ? '#EFF3FB' : '#fff'; ?>
            <tr style="background:<?= $bg ?>;">
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars(PunishmentType::GetById((int)$p['punishment_type']) ?? '?') ?></td>
                <td><?= htmlspecialchars($p['reason'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['start_date'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['end_date'] ?? 'Never') ?></td>
                <td><?= $p['active'] ? 'Yes' : 'No' ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?= Footer::render() ?>