<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Economy\Common\RobuxBalance;
use Roblox\Economy\Common\TicketsBalance;
use Roblox\Moderation\Punishment;
use Roblox\Moderation\PunishmentType;
use UserControls\Admi\Header;
use UserControls\Admi\Footer;

$authUser = Auth::GetAuthenticatedUserInfo();
if (!$authUser || $authUser['id'] !== 1) {
    header("Location: /");
    exit;
}

$message = '';
$messageType = '';
$targetUser = null;
$targetId = 0;

// Load user by ID
if (isset($_GET['ID'])) {
    $targetId = (int) $_GET['ID'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([':id' => $targetId]);
    $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $targetId = (int) ($_POST['user_id'] ?? $_GET['ID'] ?? 0);

    // Reload user
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute([':id' => $targetId]);
    $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($action === 'search_id') {
        $targetId = (int) $_POST['search_id'];
        header("Location: /Admi/Users/UserAdmin.aspx?ID=$targetId");
        exit;
    }

    if ($action === 'search_name') {
        $name = trim($_POST['search_name']);
        $stmt = $conn->prepare("SELECT id FROM users WHERE username ILIKE :n LIMIT 1");
        $stmt->execute([':n' => $name]);
        $found = $stmt->fetchColumn();
        if ($found) {
            header("Location: /Admi/Users/UserAdmin.aspx?ID=$found");
            exit;
        }
        $message = "User not found.";
        $messageType = 'error';
    }

    if ($action === 'update_user') {
        $blurb = trim($_POST['blurb'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $conn->prepare("UPDATE users SET description = :d, email = :e, updated = NOW() WHERE id = :id")
            ->execute([':d' => $blurb, ':e' => $email, ':id' => $targetId]);
        if (!empty($password)) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $conn->prepare("UPDATE users SET password = :p WHERE id = :id")->execute([':p' => $hash, ':id' => $targetId]);
        }
        $message = "User updated.";
        $messageType = 'success';
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $targetId]);
        $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($action === 'give') {
        $robuxAmt = (int) ($_POST['robux'] ?? 0);
        $ticketsAmt = (int) ($_POST['tickets'] ?? 0);
        if ($robuxAmt > 0) {
            $r = new RobuxBalance($targetId);
            $r->Credit($robuxAmt);
        }
        if ($ticketsAmt > 0) {
            $t = new TicketsBalance($targetId);
            $t->Credit($ticketsAmt);
        }
        $message = "Currency given.";
        $messageType = 'success';
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $targetId]);
        $targetUser = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($action === 'add_note') {
        $note = trim($_POST['note'] ?? '');
        if (!empty($note)) {
            try {
                $conn->prepare("INSERT INTO admin_notes (user_id, author_id, note, created) VALUES (:uid, :aid, :note, NOW())")
                    ->execute([':uid' => $targetId, ':aid' => $authUser['id'], ':note' => $note]);
                $message = "Note added.";
                $messageType = 'success';
            } catch (Exception $e) {
                $message = "Note table not set up yet.";
                $messageType = 'error';
            }
        }
    }

    if ($action === 'add_punishment') {
        $typeId = (int) ($_POST['punishment_type'] ?? 0);
        $reason = trim($_POST['reason'] ?? '');
        if ($typeId > 0) {
            try {
                Punishment::create($targetId, $typeId, $reason ?: null);
                // If it's a delete (type 7), also ban the account
                if ($typeId === 7) {
                    $conn->prepare("UPDATE users SET account_status_id = 2 WHERE id = :id")->execute([':id' => $targetId]);
                    $targetUser['account_status_id'] = 2;
                }
                // If it's any ban type, ban the account
                if ($typeId >= 3) {
                    $conn->prepare("UPDATE users SET account_status_id = 2 WHERE id = :id")->execute([':id' => $targetId]);
                    $targetUser['account_status_id'] = 2;
                }
                $message = "Punishment applied: " . PunishmentType::GetById($typeId);
                $messageType = 'success';
            } catch (Exception $e) {
                $message = "Failed to apply punishment: " . $e->getMessage();
                $messageType = 'error';
            }
        }
    }

    if ($action === 'unban_user') {
        $conn->prepare("UPDATE users SET account_status_id = 1 WHERE id = :id")->execute([':id' => $targetId]);
        // Deactivate all active punishments
        try {
            $conn->prepare("UPDATE punishments SET active = FALSE WHERE user_id = :uid")
                ->execute([':uid' => $targetId]);
        } catch (Exception $e) {
        }
        $message = "User unbanned.";
        $messageType = 'success';
        $targetUser['account_status_id'] = 1;
    }
}

// Get notes
$notes = [];
if ($targetUser) {
    try {
        $stmt = $conn->prepare("SELECT n.*, u.username as author FROM admin_notes n LEFT JOIN users u ON n.author_id = u.id WHERE n.user_id = :id ORDER BY n.created DESC LIMIT 20");
        $stmt->execute([':id' => $targetUser['id']]);
        $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $notes = [];
    }
}

// Get punishments
$punishments = [];
if ($targetUser) {
    try {
        Punishment::deactivateExpiredPunishments();
        $punishments = Punishment::getPunishmentsByUserIDPaged(0, 20, $targetUser['id']);
    } catch (Exception $e) {
        $punishments = [];
    }
}

$memNames = [0 => 'None', 1 => 'Builders Club', 2 => 'Turbo BC', 3 => 'Outrageous BC'];

echo Header::render();
?>
<div class="adminContent" style="margin-top:0;padding-top:1.6em;">

    <?php if ($message): ?>
        <div
            style="padding:4px 8px;margin-bottom:10px;border:1px solid;font-size:11px;<?= $messageType === 'success' ? 'background:#dfd;border-color:#090;color:#060' : 'background:#fdd;border-color:#900;color:#600' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div style="display:flex;gap:16px;flex-wrap:wrap;align-items:flex-start;">

        <!-- LEFT COLUMN -->
        <div style="flex:1;min-width:460px;">

            <!-- Account Summary -->
            <fieldset style="margin-bottom:10px;">
                <legend><b>Account Summary</b></legend>
                <table cellpadding="3" style="font-size:11px;width:100%;">
                    <tr>
                        <td width="160"><b>User Name:</b></td>
                        <td><?= $targetUser ? htmlspecialchars($targetUser['username']) : '—' ?></td>
                    </tr>
                    <tr>
                        <td><b>Moderation Status:</b></td>
                        <td><?= $targetUser ? ($targetUser['account_status_id'] == 2 ? '<span>Deleted</span>' : 'OK') : '—' ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>User ID:</b></td>
                        <td>
                            <form method="post" style="display:inline">
                                <input type="hidden" name="action" value="search_id">
                                <input type="text" name="search_id" value="<?= $targetUser ? $targetUser['id'] : '' ?>"
                                    style="width:80px">
                                <input type="submit" value="Search">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td><b>User Name:</b></td>
                        <td>
                            <form method="post" style="display:inline">
                                <input type="hidden" name="action" value="search_name">
                                <input type="text" name="search_name"
                                    value="<?= $targetUser ? htmlspecialchars($targetUser['username']) : '' ?>"
                                    style="width:120px">
                                <input type="submit" value="Search">
                            </form>
                        </td>
                    </tr>
                    <?php if ($targetUser): ?>
                        <tr>
                            <td><b>Builders Club Member:</b></td>
                            <td><input type="checkbox" <?= $targetUser['membership_type'] > 0 ? 'checked' : '' ?> disabled>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Builders Club Type:</b></td>
                            <td><?= $memNames[$targetUser['membership_type'] ?? 0] ?? 'N/A' ?></td>
                        </tr>
                        <tr>
                            <td><b>Builders Club Expiration Date:</b></td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td><b>Builders Club Renewal Date:</b></td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td><b>Loyal Since:</b></td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td><b>Current Location:</b></td>
                            <td>[ Offline ]</td>
                        </tr>
                    <?php endif; ?>
                </table>

                <?php if ($targetUser): ?>
                    <div style="display:flex;gap:16px;margin-top:8px;">
                        <div>
                            <img src="/Thumbs/Avatar.ashx?userId=<?= $targetUser['id'] ?>" width="110" height="110"
                                onerror="this.src='/Images/Placeholder1024x1024.png'">
                        </div>
                        <div>
                            <fieldset style="font-size:11px;">
                                <legend>Cheat Detections</legend>
                                <table border="1" cellpadding="2" cellspacing="0"
                                    style="border-collapse:collapse;font-size:11px;">
                                    <thead style="background:#4a76b8;color:#fff;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Action</th>
                                            <th>Detected Behavior</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" style="text-align:center">No Results Found</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                            <div style="margin-top:8px;font-size:11px;line-height:1.8;">
                                <a href="/User.aspx?ID=<?= $targetUser['id'] ?>">User Homepage</a><br>
                                Machine Info<br>
                                <a href="/Admi/Users/ModerateUser.aspx?ID=<?= $targetUser['id'] ?>">Moderate User</a><br>
                                Payment Info
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </fieldset>

            <!-- Billing Info -->
            <fieldset style="margin-bottom:10px;">
                <legend><b>Billing Info</b></legend>
                <table cellpadding="3" style="font-size:11px;">
                    <tr>
                        <td width="160"><b>Billing Name:</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Postal Code:</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Billing Email:</b></td>
                        <td><?= $targetUser ? htmlspecialchars($targetUser['email'] ?? '') : '' ?></td>
                    </tr>
                    <tr>
                        <td><b>Credit Card Info:</b></td>
                        <td></td>
                    </tr>
                </table>
            </fieldset>

            <!-- Punishments -->
            <fieldset style="margin-bottom:10px;">
                <legend><b>Punishments</b></legend>
                <?php if ($targetUser): ?>
                    <table border="1" cellpadding="3" cellspacing="0"
                        style="border-collapse:collapse;font-size:11px;width:100%;">
                        <thead style="background:#4a76b8;color:#fff;">
                            <tr>
                                <th>ID</th>
                                <th>Action</th>
                                <th>Moderator</th>
                                <th>Created</th>
                                <th>Expiration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($punishments)): ?>
                                <tr>
                                    <td colspan="5" style="text-align:center">No punishments on record.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($punishments as $p): ?>
                                    <tr style="<?= $p->active ? 'background:#ffd' : '' ?>">
                                        <td><?= $p->id ?></td>
                                        <td><?= htmlspecialchars(PunishmentType::GetById($p->punishmentType) ?? 'Unknown') ?></td>
                                        <td><?= htmlspecialchars($authUser['username']) ?></td>
                                        <td><?= $p->startDate ? date('n/j/Y g:i:s A', strtotime($p->startDate)) : 'N/A' ?></td>
                                        <td><?= $p->endDate ? date('n/j/Y g:i:s A', strtotime($p->endDate)) : 'Permanent' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <br>
                <?php endif; ?>
            </fieldset>

            <!-- Profile Ratings -->
            <fieldset>
                <legend><b>Profile Ratings</b></legend>
                <p style="font-size:11px">No profile ratings available.</p>
            </fieldset>

        </div><!-- end left column -->

        <!-- RIGHT COLUMN -->
        <div style="width:320px;">

            <!-- User Notes -->
            <fieldset style="margin-bottom:10px;">
                <legend><b>User Notes</b></legend>
                <?php if ($targetUser): ?>
                    <form method="post">
                        <input type="hidden" name="action" value="add_note">
                        <input type="hidden" name="user_id" value="<?= $targetUser['id'] ?>">
                        <textarea name="note" rows="4" style="width:100%;font-size:11px;"></textarea><br>
                        <input type="submit" value="Add Note">
                    </form>
                    <div style="margin-top:8px;">
                        <?php if (empty($notes)): ?>
                            <p style="font-size:11px">No notes yet.</p>
                        <?php else: ?>
                            <?php foreach ($notes as $note): ?>
                                <div style="background:#b8c9e8;border:1px solid #aaa;padding:4px;margin-bottom:4px;font-size:11px;">
                                    <div style="text-align:right;font-size:10px;color:#333">
                                        <?= date('n/j/Y g:i:s A', strtotime($note['created'])) ?>
                                    </div>
                                    <div><?= htmlspecialchars($note['note']) ?></div>
                                    <div style="color:#00f">-<?= htmlspecialchars($note['author'] ?? 'Admin') ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p style="font-size:11px">No user selected.</p>
                <?php endif; ?>
            </fieldset>

            <!-- Update User -->
            <fieldset style="margin-bottom:10px;">
                <legend><b>Update User</b></legend>
                <?php if ($targetUser): ?>
                    <form method="post">
                        <input type="hidden" name="action" value="update_user">
                        <input type="hidden" name="user_id" value="<?= $targetUser['id'] ?>">
                        <table cellpadding="3" style="font-size:11px;width:100%;">
                            <tr>
                                <td width="80"><b>User Blurb:</b></td>
                                <td colspan="2">
                                    <textarea name="blurb" rows="4"
                                        style="width:100%;font-size:11px;"><?= htmlspecialchars($targetUser['description'] ?? '') ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Email:</b></td>
                                <td><input type="text" name="email"
                                        value="<?= htmlspecialchars($targetUser['email'] ?? '') ?>" style="width:180px">
                                </td>
                            </tr>
                            <tr>
                                <td><b>Password:</b></td>
                                <td><input type="password" name="password" placeholder="Leave blank to keep"
                                        style="width:180px"></td>
                            </tr>
                            <tr>
                                <td><b>User Created:</b></td>
                                <td><?= date('n/j/Y g:i:s A', strtotime($targetUser['created'])) ?></td>
                            </tr>
                            <tr>
                                <td><b>Last Location:</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Last Activity:</b></td>
                                <td><?= $targetUser['lastactive'] ? date('n/j/Y', strtotime($targetUser['lastactive'])) : 'N/A' ?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Approved:</b></td>
                                <td><input type="checkbox" checked disabled></td>
                            </tr>
                        </table>
                        <input type="submit" value="Update User">
                    </form>
                <?php else: ?>
                    <p style="font-size:11px">No user selected.</p>
                <?php endif; ?>
            </fieldset>

            <!-- Give and Take -->
            <fieldset>
                <legend><b>Give and Take</b></legend>
                <?php if ($targetUser): ?>
                    <form method="post">
                        <input type="hidden" name="action" value="give">
                        <input type="hidden" name="user_id" value="<?= $targetUser['id'] ?>">
                        <table cellpadding="3" style="font-size:11px;">
                            <tr>
                                <td><b>Robux:</b></td>
                                <td><input type="number" name="robux" value="0" style="width:80px" min="0"></td>
                                <td>Max: &nbsp;<?= number_format($targetUser['robux'] ?? 0) ?></td>
                            </tr>
                            <tr>
                                <td><b>Tickets:</b></td>
                                <td><input type="number" name="tickets" value="0" style="width:80px" min="0"></td>
                                <td>Max: &nbsp;<?= number_format($targetUser['tickets'] ?? 0) ?></td>
                            </tr>
                            <tr>
                                <td><b>Asset:</b></td>
                                <td><input type="text" name="asset_id" style="width:80px"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Badge Credit:</b></td>
                                <td><input type="number" name="badge_credit" value="0" style="width:80px"></td>
                                <td>Max: &nbsp;0</td>
                            </tr>
                        </table>
                        <input type="submit" value="Give">
                    </form>
                <?php else: ?>
                    <p style="font-size:11px">No user selected.</p>
                <?php endif; ?>
            </fieldset>

        </div><!-- end right column -->
    </div><!-- end flex -->
</div>
<?= Footer::render() ?>