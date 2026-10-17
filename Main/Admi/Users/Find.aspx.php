<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use UserControls\Admi\Header;
use UserControls\Admi\Footer;

$authUser = Auth::GetAuthenticatedUserInfo();
if (!$authUser || $authUser['id'] !== 1) { header('Location: /'); exit; }

$usernameKw = trim($_GET['username'] ?? '');
$idKw       = trim($_GET['userid'] ?? '');
$emailKw    = trim($_GET['email'] ?? '');
$results    = [];
$searchedBy = '';

if ($usernameKw !== '') {
    $searchedBy = 'username';
    $stmt = $conn->prepare("
        SELECT id, username, email, robux, tickets, membership_type,
               account_status_id, created, lastactive, presence_status, moderation_status
        FROM users WHERE username ILIKE :kw LIMIT 50
    ");
    $stmt->execute([':kw' => '%' . $usernameKw . '%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($idKw !== '') {
    $searchedBy = 'id';
    $stmt = $conn->prepare("
        SELECT id, username, email, robux, tickets, membership_type,
               account_status_id, created, lastactive, presence_status, moderation_status
        FROM users WHERE CAST(id AS TEXT) = :kw LIMIT 1
    ");
    $stmt->execute([':kw' => $idKw]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($emailKw !== '') {
    $searchedBy = 'email';
    $stmt = $conn->prepare("
        SELECT id, username, email, robux, tickets, membership_type,
               account_status_id, created, lastactive, presence_status, moderation_status
        FROM users WHERE email ILIKE :kw LIMIT 50
    ");
    $stmt->execute([':kw' => '%' . $emailKw . '%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// handle bulk moderate
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['moderate_ids'])) {
    $ids = array_map('intval', (array)$_POST['moderate_ids']);
    foreach ($ids as $mid) {
        if ($mid > 0) {
            header('Location: /Admi/Users/ModerateUser.aspx?ID=' . $mid);
            exit;
        }
    }
}

$memNames = [0 => 'None', 1 => 'BC', 2 => 'TBC', 3 => 'OBC'];
$modStatusNames = [0 => 'OK', 2 => 'Deleted'];

echo Header::render();
?>
<div class="adminContent" style="margin-top:0;padding-top:1.6em;">
    <p>Billing: Billing Search has been moved <a href="/Admi/AccountUpgrades/Payments.aspx">HERE</a></p>
    <br>

    <form method="get" action="/Admi/Users/Find.aspx" style="display:inline;">
        User Name <input name="username" value="<?= htmlspecialchars($usernameKw) ?>">
        <button type="submit">Search By Username</button>
    </form>
    <br><hr><br>

    <form method="get" action="/Admi/Users/Find.aspx" style="display:inline;">
        User ID <input name="userid" value="<?= htmlspecialchars($idKw) ?>">
        <button type="submit">Search By User ID</button>
    </form>
    <br><hr><br>

    <form method="get" action="/Admi/Users/Find.aspx" style="display:inline;">
        Email Address <input name="email" value="<?= htmlspecialchars($emailKw) ?>">
        <button type="submit">Search By Email Address</button>
    </form>
    <br><hr>

    User Search Results

    <?php if ($searchedBy !== '' && empty($results)): ?>
        <p style="font-size:11px;">No users found.</p>
    <?php elseif (!empty($results)): ?>
    <br>
    <form method="post" action="/Admi/Users/Find.aspx?username=<?= urlencode($usernameKw) ?>&userid=<?= urlencode($idKw) ?>&email=<?= urlencode($emailKw) ?>">
    <table cellpadding="4" cellspacing="0" style="border-collapse:collapse;font-size:11px;width:100%;GridLines:None;">
        <thead style="background:#507CD1;color:#fff;font-weight:bold;">
            <tr>
                <th>Name</th>
                <th>ID</th>
                <th>Online</th>
                <th>Email</th>
                <th>RoleSet</th>
                <th>Creation Date</th>
                <th>Last Activity</th>
                <th>Approved</th>
                <th>BC</th>
                <th>Moderation Status</th>
                <th>Moderate User</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $i => $u):
                $bg        = $i % 2 === 0 ? '#EFF3FB' : '#fff';
                $isOnline  = ($u['presence_status'] ?? 0) > 0;
                $isApproved = (int)$u['account_status_id'] !== 2;
                $lastActive = $u['lastactive'] ? date('n/j/Y g:i A', (int)$u['lastactive']) : 'Never';
                $created    = $u['created'] ? date('n/j/Y', strtotime($u['created'])) : 'Unknown';
                $modStatus  = $modStatusNames[$u['account_status_id'] ?? 0] ?? 'OK';
            ?>
            <tr style="background:<?= $bg ?>;">
                <td><a href="/Admi/Users/UserAdmin.aspx?ID=<?= $u['id'] ?>"><?= htmlspecialchars($u['username']) ?></a></td>
                <td><?= $u['id'] ?></td>
                <td><input type="checkbox" disabled <?= $isOnline ? 'checked' : '' ?>></td>
                <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
                <td>Member</td> <!-- make it so it checks user dependecy -->
                <td><?= $created ?></td>
                <td><?= $lastActive ?></td>
                <td><input type="checkbox" disabled <?= $isApproved ? 'checked' : '' ?>></td>
                <td><?= $memNames[$u['membership_type'] ?? 0] ?></td>
                <td><?= htmlspecialchars($modStatus) ?></td>
                <td style="text-align:center;"><input type="checkbox" name="moderate_ids[]" value="<?= $u['id'] ?>"></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <button type="submit">Moderate Selected Users</button>
    </form>
    <?php endif; ?>
</div>
<?= Footer::render() ?>