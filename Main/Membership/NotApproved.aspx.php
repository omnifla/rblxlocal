<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Moderation\Punishment;
use Roblox\Moderation\PunishmentType;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;

$user = Auth::GetAuthenticatedUserInfo();
if (!$user) {
    header('Location: /login');
    exit;
}

$userId = (int) $user['id'];

if ((int) $user['account_status_id'] !== 2) {
    header('Location: /home');
    exit;
}

Punishment::deactivateExpiredPunishments();

$checkStmt = $conn->prepare("SELECT account_status_id FROM users WHERE id = :id LIMIT 1");
$checkStmt->execute([':id' => $userId]);
if ((int) $checkStmt->fetchColumn() !== 2) {
    header('Location: /home');
    exit;
}

$stmt = $conn->prepare("
    SELECT * FROM punishments
    WHERE user_id = :uid AND active = TRUE
    ORDER BY id DESC LIMIT 1
");
$stmt->execute([':uid' => $userId]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    $conn->prepare("UPDATE users SET account_status_id = 1 WHERE id = :uid")->execute([':uid' => $userId]);
    header('Location: /home');
    exit;
}

$p = new Punishment();
$p->id = (int) $row['id'];
$p->userId = $userId;
$p->punishmentType = (int) $row['punishment_type'];
$p->reason = $row['reason'] ?? null;
$p->startDate = $row['start_date'] ?? null;
$p->endDate = $row['end_date'] ?? null;
$p->active = true;

$isPermanent = $p->isPermanent();
$isExpired = $p->isExpired();
$canReactivate = !$isPermanent && ($p->punishmentType <= 2 || $isExpired);
$isTimedBan = !$isPermanent && !$canReactivate && $p->endDate;

$typeName = $p->getTypeNameSelf();
$reviewedDate = $p->getReviewedDateFormatted();
$endDateFmt = $p->endDate ? date('n/j/Y g:i:s A', strtotime($p->endDate)) : null;

$durationMap = [
    3 => '1 Day', 4 => '3 Days', 5 => '7 Days', 6 => '14 Days',
];
$displayNames = [
    1 => 'Warning', 2 => 'Reminder', 7 => 'Account Deleted', 8 => 'Account Deleted',
];

$header = match(true) {
    $isPermanent                          => 'Account Deleted',
    $isTimedBan && !$isExpired            => 'Banned for ' . ($durationMap[$p->punishmentType] ?? 'a period'),
    $isTimedBan && $isExpired             => 'Banned for ' . ($durationMap[$p->punishmentType] ?? 'a period'),
    $canReactivate                        => $displayNames[$p->punishmentType] ?? 'Account Warning',
    default                               => 'Account Disabled',
};

$evidence = json_decode($row['evidence'] ?? '[]', true) ?: [];
$ruleBreakTypes = [
    1 => 'Profanity',
    2 => 'Harassment',
    3 => 'Spam',
    4 => 'Advertising',
    5 => 'Scamming',
    6 => 'Adult Content',
    7 => 'Inappropriate',
    8 => 'Privacy',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reactivate']) && $canReactivate && isset($_POST['tos'])) {
        $conn->prepare("UPDATE punishments SET active = FALSE WHERE id = :id")->execute([':id' => $p->id]);
        $conn->prepare("UPDATE users SET account_status_id = 1 WHERE id = :uid")->execute([':uid' => $userId]);
        header('Location: /home');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Account Disabled - RBLX.local</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___486ee4e2def9b96aeaf9ebb663ab510e_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___91ce90e508d798217cc5452e978970d5_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___7000c43d73500e63554d81258494fa21_m.css">

    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
    <script
        type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
    <script
        type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
    <script
        type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

</head>

<body>
    <div class="wrap">
        <?= SiteHeader::render() ?>
        <div class="container-main">
            <div class="content">
                <div style="margin:150px auto;width:500px;border:black thin solid;padding:22px;">
                    <h2><?= htmlspecialchars($header) ?></h2>

                    <p>Our content monitors have determined that your behavior at RBLX.local has been in violation of
                        our Terms of Service.
                        <?php if ($isTimedBan): ?>
                            We will terminate your account if you do not abide by the rules.
                        <?php endif; ?>
                    </p>

                    <p>Reviewed: <strong><?= htmlspecialchars($reviewedDate) ?></strong></p>

                    <?php if ($p->reason): ?>
                        <p>Moderator Note: <span style="font-weight:bold;"><?= htmlspecialchars($p->reason) ?></span></p>
                    <?php endif; ?>

                    <?php foreach ($evidence as $item):
                        $category = htmlspecialchars($ruleBreakTypes[$item['category'] ?? 7] ?? 'Inappropriate');
                        $itemContent = htmlspecialchars($item['content'] ?? '');
                        ?>
                        <div
                            style="background-color:#fff;border:solid 1px #000;margin-bottom:5px;padding:10px;width:438px;">
                            <div style="margin-bottom:5px;"><strong>Reason:</strong> <?= $category ?></div>
                            <div>
                                <strong>Offensive Item:</strong>
                                <blockquote><?= $itemContent ?></blockquote>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php if ($canReactivate): ?>
                        <p>Please abide by the RBLX.local Community Guidelines so that RBLX.local can be fun for users of
                            all ages.</p>
                        <p>You may re-activate your account by agreeing to our <a href="/info/terms-of-service">Terms of
                                Service</a>.</p>
                        <div style="text-align:center;">
                            <form method="post">
                                <input type="checkbox" id="tos" name="tos" value="tos" onclick="document.getElementById('reactivate-btn').disabled = !this.checked;">
                                <label for="tos">I agree</label><br><br>
                                <button type="submit" name="reactivate" id="reactivate-btn" disabled>Reactivate My
                                    Account</button><br><br>
                                <button type="submit" name="logout" formaction="/Authentication/LogOut.php">Logout</button>
                            </form>
                        </div>
                    <?php elseif ($isTimedBan): ?>
                        <p>Your account has been disabled. You may re-activate it after
                            <strong><?= htmlspecialchars($endDateFmt) ?></strong>.
                        </p>
                        <p>If you wish to appeal, please send a email to <a
                                href="mailto:appeals@roblox.local">appeals@roblox.local</a>.</p>
                        <div style="text-align:center;">
                            <form method="post">
                                <button type="submit" name="logout" formaction="/Authentication/LogOut.php">Logout</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <p>Your account has been terminated.</p>
                        <p>If you wish to appeal, please send a email to <a
                                href="mailto:appeals@roblox.local">appeals@roblox.local</a>.</p>
                        <div style="text-align:center;">
                            <form method="post" action="/Authentication/LogOut.php">
                                <button type="submit" name="logout">Logout</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
