<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\User;
use Roblox\Moderation\Punishment;
use Roblox\Moderation\PunishmentType;
use UserControls\Admi\Header;
use UserControls\Admi\Footer;

$authUser = Auth::GetAuthenticatedUserInfo();
if (!$authUser || $authUser['id'] !== 1) {
    header('Location: /');
    exit;
}

$message = '';
$messageType = '';

$targetId = (int) ($_GET['ID'] ?? 0);
$targetUser = null;

if ($targetId > 0) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([':id' => $targetId]);
    $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    $targetId = (int) ($_POST['user_id'] ?? $targetId);

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([':id' => $targetId]);
    $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$targetUser) {
        $message = 'User could not be found.';
        $messageType = 'error';
    } elseif ($action === 'moderate') {
        $punishmentType = (int) ($_POST['punishment_type'] ?? 0);
        $noteToUser = trim($_POST['note_to_user'] ?? '');
        $internalNote = trim($_POST['internal_note'] ?? '');
        $scrubUsername = isset($_POST['scrub_username']);

        if ($punishmentType > 0) {
            try {
                Punishment::create($targetId, $punishmentType, $noteToUser ?: null, null, [], (int) $authUser['id']);
                if ($scrubUsername) {
                    $conn->prepare("UPDATE users SET username = '[Content Deleted]', account_status_id = 2 WHERE id = :id")
                        ->execute([':id' => $targetId]);
                }
                if (!empty($internalNote)) {
                    try {
                        $conn->prepare("INSERT INTO admin_notes (user_id, author_id, note, created) VALUES (:uid, :aid, :note, NOW())")
                            ->execute([':uid' => $targetId, ':aid' => $authUser['id'], ':note' => $internalNote]);
                    } catch (\Exception $e) {
                    }
                }
                $message = 'Moderation action applied: ' . PunishmentType::GetById($punishmentType);
                $messageType = 'success';

                $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
                $stmt->execute([':id' => $targetId]);
                $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (\Exception $e) {
                $message = 'Error: ' . $e->getMessage();
                $messageType = 'error';
            }
        }
    }
}

$punishments = [];
if ($targetUser) {
    Punishment::deactivateExpiredPunishments();
    $punishments = Punishment::getPunishmentsByUserIDPaged(0, 20, $targetUser['id']);
}

$memNames = [0 => 'Free Member', 1 => 'Builders Club', 2 => 'Turbo BC', 3 => 'Outrageous BC'];
$autofill = ['Spam', 'Swear', 'Personal Info', 'Spam Alt', 'Dating', 'Inappropriate Talk', 'Link', 'Harassment', 'Scam', 'Bad Image'];

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" class="adminStyle">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">
    <title>ROBLOX | Administration</title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="/js/Microsoft/MicrosoftAjaxTreeView.js" type="text/javascript"></script>
    <script src="/js/jquery/jquery-1.11.1.js" type="text/javascript"></script>
    <script src="/js/JsTree/jstree.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/CSS/Base/CSS/Roblox.css">
    <link rel="stylesheet" href="/CSS/RBXCommon.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/AccountBalance.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Admin.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Admin2.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Ads.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/AgeUpEmailVerifyPage.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Asset.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Badges.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/carouselpager.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Catalog.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CharacterCustomization.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CharacterSelectAndInstallInstructions.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CommonForms.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ContentAdapters.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ContentBuilder.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Contest.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CreditCardExpireModal.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CuratedGames.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/CurrencyExchange.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/DarkGradientBox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Frontpage.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Games.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/GenericModal.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/GroupRoleSetMembersPane.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Groups.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Help.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/IframeHeader.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/iFrameLogin.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Inbox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Info.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Install.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Item.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/LandingGames.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/LinkInventory.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ManageAccount.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Membership.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/MenuRedesign.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Message.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/MyAccount.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/MyMoney.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/NewCatalog.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/NewToolBox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Parents.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/party.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/PersonalServerAccessPrivilegesRoleSet.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Place.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/PlaceLauncher.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Profile.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Q.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/RevisedCharacterSelectModal.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Sets.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ShadowedStandardBox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/ShareRoblox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Signup.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Store.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Studio2Alert.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/StyleGuide.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/tipsy.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Toolbox.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Trade.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/UnifiedModal.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Upgrades.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Upload.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/User.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/Utility.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/VideoPreRoll.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/BuildersClub.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Catalog.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/DarkGradientBox.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Games.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Inbox.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Item.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/MyRoblox.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Roblox.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Upgrades.css">
    <link rel="stylesheet" href="/CSS/RBX2/CSS/Utility.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/jstree.css">
    <style>
        html,
        body {
            height: auto;
            margin: 0;
            padding: 0;
        }

        form {
            height: auto !important;
        }

        #Body {
            min-height: 0 !important;
        }
    </style>
</head>
<?= Header::renderBanner() ?>
<div class="adminContent">

    <?php if ($message): ?>
        <div
            style="padding:4px 8px;margin-bottom:10px;border:1px solid;font-size:11px;<?= $messageType === 'success' ? 'background:#dfd;border-color:#090;color:#060' : 'background:#fdd;border-color:#900;color:#600' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <?php if (!$targetUser): ?>
        <p>No user selected. Use <a href="/Admi/Users/Find.aspx">Find User</a> to locate a user.</p>
    <?php else: ?>

        <div style="background:#c8a000;color:#000;padding:6px 10px;font-size:13px;font-weight:bold;margin-bottom:8px;">
            Current abuses to review for <?= htmlspecialchars($targetUser['username']) ?>
        </div>

        <div style="background:#f9f0d0;border:1px solid #c8a000;padding:8px;margin-bottom:10px;">
            <div style="background:#000;color:#fff;font-size:12px;font-weight:bold;padding:4px 8px;margin-bottom:6px;">
                Privacy (UserStatus)
            </div>
            <div style="border:1px solid #900;padding:6px;background:#fff;margin-bottom:10px;font-size:11px;">
                <?= htmlspecialchars($targetUser['description'] ?? '(no status set)') ?>
            </div>

            <form method="post">
                <input type="hidden" name="action" value="moderate">
                <input type="hidden" name="user_id" value="<?= $targetUser['id'] ?>">

                <div style="display:flex;gap:20px;flex-wrap:wrap;">
                    <div>
                        <b>Action:</b><br>
                        <label><input type="radio" name="punishment_type" value="0" checked> None</label><br>
                        <?php foreach (PunishmentType::$types as $id => $name): ?>
                            <label><input type="radio" name="punishment_type" value="<?= $id ?>">
                                <?= htmlspecialchars($name) ?></label><br>
                        <?php endforeach; ?>
                    </div>

                    <div>
                        <b>Auto-fill fields:</b><br>
                        <?php foreach ($autofill as $af): ?>
                            <button type="button" onclick="document.querySelector('[name=note_to_user]').value='<?= $af ?>'"
                                style="font-size:11px;width:120px;margin-bottom:2px;"><?= $af ?></button><br>
                        <?php endforeach; ?>
                    </div>

                    <div style="flex:1;min-width:200px;">
                        <b>Note to <?= htmlspecialchars($targetUser['username']) ?>:</b><br>
                        <textarea name="note_to_user" rows="4" style="width:100%;font-size:11px;"></textarea>
                        <br><br>
                        <b>Internal Note:</b><br>
                        <textarea name="internal_note" rows="4" style="width:100%;font-size:11px;"></textarea>
                        <br><br>
                        <label><input type="checkbox" name="escalate_report"> <b>Escalate Report</b></label><br><br>
                        <label><input type="checkbox" name="scrub_username"> <b>Scrub User Name</b></label>
                    </div>
                </div>

                <br>
                <div style="text-align:center;">
                    <input type="submit" value="Submit" style="padding:4px 40px;font-size:12px;margin-right:10px;">
                    <a href="/Admi/Users/ModerateUser.aspx"><input type="button" value="Skip"
                            style="padding:4px 40px;font-size:12px;"></a>
                </div>
            </form>
        </div>

        <div style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-start;">
            <div style="background:#c8a000;border:2px solid #8b6f00;padding:0;width:200px;">
                <div style="background:#c8a000;padding:4px 8px;font-weight:bold;font-size:12px;">
                    <?= htmlspecialchars($targetUser['username']) ?>
                    <span
                        style="float:right;font-weight:normal;"><?= $memNames[$targetUser['membership_type'] ?? 0] ?></span>
                </div>
                <div style="background:#f9f0d0;padding:6px;display:flex;gap:8px;align-items:flex-start;">
                    <img src="/Thumbs/Avatar.ashx?userId=<?= $targetUser['id'] ?>" width="80" height="80"
                        style="flex-shrink:0;" onerror="this.src='/Images/Placeholder1024x1024.png'">
                    <div style="font-size:10px;line-height:1.8;">
                        <div style="color:#900;font-weight:bold;">Moderation</div>
                        <div>● <span style="color:#888">[ Offline ]</span></div>
                        <div><a href="/User.aspx?ID=<?= $targetUser['id'] ?>">Visit Profile</a></div>
                        <div><a href="/Admi/Users/ModerateUser.aspx?ID=<?= $targetUser['id'] ?>">Visit Moderation
                                Profile</a></div>
                        <div><a href="/Admi/Users/UserAdmin.aspx?ID=<?= $targetUser['id'] ?>">Visit Admin Profile</a></div>
                        <div>Status:
                            <?= $targetUser['account_status_id'] == 2 ? 'Deleted' : 'OK' ?>
                        </div>
                        <div style="color:#900;font-weight:bold;margin-top:4px;">Information</div>
                        <div>Robux: <?= number_format($targetUser['robux'] ?? 0) ?></div>
                        <div>Tickets: <?= number_format($targetUser['tickets'] ?? 0) ?></div>
                        <div>Created: <?= date('n/j/Y', strtotime($targetUser['created'])) ?></div>
                    </div>
                </div>
                <div style="background:#c8a000;text-align:center;padding:2px;font-size:10px;">Moderation Card</div>
            </div>

            <div style="flex:1;">
                <div style="background:#c8a000;color:#000;font-weight:bold;padding:4px 8px;font-size:12px;">Past Punishments
                </div>
                <table border="1" cellpadding="3" cellspacing="0"
                    style="border-collapse:collapse;font-size:11px;width:100%;background:#f9f0d0;">
                    <thead style="background:#7a5c00;color:#fff;">
                        <tr>
                            <th>ID</th>
                            <th>Action</th>
                            <th>Moderator</th>
                            <th>Note</th>
                            <th>Created</th>
                            <th>Expires</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($punishments)): ?>
                            <tr>
                                <td colspan="6" style="text-align:center;padding:6px;">No punishments on record.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($punishments as $i => $p):
                                $bg = $i % 2 === 0 ? '#f9f0d0' : '#fff'; ?>
                                <tr style="background:<?= $bg ?>;">
                                    <td><?= $p->id ?></td>
                                    <td><?= htmlspecialchars(PunishmentType::GetById($p->punishmentType) ?? 'Unknown') ?></td>
                                    <td><?= htmlspecialchars(User::get($p->moderatorId ?? 1)->getName()) ?></td>
                                    <td><?= htmlspecialchars($p->reason ?? '') ?></td>
                                    <td><?= $p->startDate ? date('n/j/Y g:i A', strtotime($p->startDate)) : 'N/A' ?></td>
                                    <td><?= $p->endDate ? date('n/j/Y g:i A', strtotime($p->endDate)) : 'Permanent' ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>
</div>
<?= Footer::render() ?>