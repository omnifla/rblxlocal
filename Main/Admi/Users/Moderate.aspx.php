<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Moderation\Punishment;
use Roblox\Moderation\PunishmentType;
use UserControls\Admi\Header;
use UserControls\Admi\Footer;

$authUser = Auth::GetAuthenticatedUserInfo();
if (!$authUser || $authUser['id'] !== 1) { header('Location: /'); exit; }

$targetId = (int)($_GET['ID'] ?? 0);
$targetUser = null;

if ($targetId) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $targetId]);
    $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

// if no ID given, pull next user with active punishment from queue
if (!$targetUser) {
    $stmt = $conn->prepare("
        SELECT u.* FROM users u
        INNER JOIN punishments p ON p.user_id = u.id
        WHERE p.active = TRUE
        AND u.account_status_id = 2
        ORDER BY p.start_date ASC
        LIMIT 1
    ");
    $stmt->execute();
    $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

echo Header::render();
?>
<div style="margin:0 auto;width:600px;">
    <div style="background:SteelBlue;color:white;padding:4px 8px;font-weight:bold;">Specifications</div>
    <div style="background:LightSteelBlue;border:1px solid LightSteelBlue;padding:10px;">
        <?php if (!$targetUser): ?>
            <p style="font-size:12px;">No users currently in moderation queue.</p>
        <?php else: ?>
            <p style="font-size:12px;">
                Currently reviewing:
                <a href="/Admi/Users/ModerateUser.aspx?ID=<?= $targetUser['id'] ?>">
                    <strong><?= htmlspecialchars($targetUser['username']) ?></strong>
                </a>
                (ID: <?= $targetUser['id'] ?>)
            </p>
        <?php endif; ?>
        <h4>This page contains:</h4>
        <ul style="font-size:12px;">
            <li>User name, user ID, basic user info.</li>
            <li>UserBlurb/Description, UserStatus.</li>
            <li>Recently modified Assets (sorted by Updated)</li>
            <li>All places (including their statuses)</li>
            <li>Hyper-links to payments, transactions on-site, trades, messages, IP addresses</li>
            <li>Moderation card &amp; past punishments</li>
        </ul>

        <?php
        // queue of users with active punishments
        $queueStmt = $conn->prepare("
            SELECT DISTINCT u.id, u.username, u.account_status_id,
                   p.punishment_type, p.start_date, p.reason
            FROM users u
            INNER JOIN punishments p ON p.user_id = u.id
            WHERE p.active = TRUE
            ORDER BY p.start_date ASC
            LIMIT 50
        ");
        $queueStmt->execute();
        $queue = $queueStmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div style="background:SteelBlue;color:white;padding:4px 8px;font-weight:bold;margin-top:12px;">Moderation Queue</div>
        <table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse;font-size:11px;width:100%;">
            <thead style="background:#507CD1;color:#fff;">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Punishment</th>
                    <th>Reason</th>
                    <th>Since</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($queue)): ?>
                <tr><td colspan="6" style="text-align:center;padding:8px;">Queue is empty.</td></tr>
                <?php else: ?>
                <?php foreach ($queue as $i => $u):
                    $bg = $i % 2 === 0 ? '#EFF3FB' : '#fff'; ?>
                <tr style="background:<?= $bg ?>;">
                    <td><?= $u['id'] ?></td>
                    <td><a href="/Admi/Users/ModerateUser.aspx?ID=<?= $u['id'] ?>"><?= htmlspecialchars($u['username']) ?></a></td>
                    <td><?= htmlspecialchars(PunishmentType::GetById((int)$u['punishment_type']) ?? '?') ?></td>
                    <td><?= htmlspecialchars($u['reason'] ?? '') ?></td>
                    <td><?= $u['start_date'] ? date('n/j/Y g:i A', strtotime($u['start_date'])) : '?' ?></td>
                    <td><a href="/Admi/Users/ModerateUser.aspx?ID=<?= $u['id'] ?>">Moderate</a></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= Footer::render() ?>