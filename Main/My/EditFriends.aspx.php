<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;

$user = Auth::GetAuthenticatedUserInfo();
$userId = (int)$user["id"];

$db = $conn;

function fetchUsersByStatus(PDO $db, int $userId, array $statuses, string $type): array {
    if ($type === 'best') {
        $sql = "SELECT u.id, u.username FROM friendrequests f
                JOIN users u ON 
                    ( (f.SenderID = u.id AND f.RecipientID = :userId) OR (f.RecipientID = u.id AND f.SenderID = :userId) )
                WHERE f.Status = ANY(:statuses) AND :userId IN (f.SenderID, f.RecipientID)";
        $stmt = $db->prepare($sql);
        $stmt->execute([':userId' => $userId, ':statuses' => $statuses]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if ($type === 'friends') {
        $sql = "SELECT u.id, u.username FROM friendrequests f
                JOIN users u ON 
                    ( (f.SenderID = u.id AND f.RecipientID = :userId) OR (f.RecipientID = u.id AND f.SenderID = :userId) )
                WHERE f.Status = 1 AND :userId IN (f.SenderID, f.RecipientID)";
        $stmt = $db->prepare($sql);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    if ($type === 'followers') {
        return [];
    }
    if ($type === 'following') {
        return [];
    }
    if ($type === 'requests') {
        $sql = "SELECT f.RequestID, u.id, u.username FROM friendrequests f
                JOIN users u ON f.SenderID = u.id
                WHERE f.RecipientID = :userId AND f.Status <> 1 AND f.Status <> 3";
        $stmt = $db->prepare($sql);
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return [];
}

$bestFriends = fetchUsersByStatus($db, $userId, [5], 'best');
$friends = fetchUsersByStatus($db, $userId, [], 'friends');
$followers = fetchUsersByStatus($db, $userId, [], 'followers');
$following = fetchUsersByStatus($db, $userId, [], 'following');
$requests = fetchUsersByStatus($db, $userId, [], 'requests');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acceptRequestId'])) {
        $requestId = intval($_POST['acceptRequestId']);
        $update = $db->prepare("UPDATE friendrequests SET Status = 1 WHERE RequestID = :rid AND RecipientID = :uid");
        $update->execute([':rid' => $requestId, ':uid' => $userId]);
        header("Location: /My/EditFriends.aspx");
        exit;
    }
    if (isset($_POST['declineRequestId'])) {
        $requestId = intval($_POST['declineRequestId']);
        $update = $db->prepare("UPDATE friendrequests SET Status = 2 WHERE RequestID = :rid AND RecipientID = :uid");
        $update->execute([':rid' => $requestId, ':uid' => $userId]);
        header("Location: /My/EditFriends.aspx");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Friends - EpicBLOX</title>
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___93d7b975be9106ab72cfa4deac3a5583_m.css">
    <style>
        .btn-decline {
            background: url("/images/btn_red_30h_t2.png") top right transparent no-repeat;
            border: 0;
            position: relative;
            height: 30px;
            color: #fff;
            font: bold 14px Arial, Helvetica, Sans-Serif;
            line-height: 1;
            padding: 0;
            margin: 0;
            cursor: pointer;
            width: 70px;
        }
        .btn-accept {
            background: url("/images/btn_green_30h_t2.png") top right transparent no-repeat;
            border: 0;
            position: relative;
            height: 30px;
            font: bold 14px Arial, Helvetica, Sans-Serif;
            line-height: 1;
            padding: 0;
            border-radius: 0;
            margin: 0 0 0 47px;
            cursor: pointer;
            width: 70px;
            color: #fff;
        }
        .tab-container {
            margin-bottom: 10px;
            user-select: none;
        }
        .tab {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #ccc;
            border: 1px solid #aaa;
            border-bottom: none;
            margin-right: 4px;
            font-weight: bold;
            color: #000;
        }
        .tab-active, .active {
            background-color: #fff;
            border-bottom: 1px solid #fff;
        }
        .tab-content {
            border: 1px solid #aaa;
            padding: 10px;
            background-color: #fff;
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        #Body {
            background-color: #f9f9f9;
            padding: 15px;
        }
        .friend-entry {
            margin-bottom: 8px;
            font-size: 14px;
        }
        .friend-entry a {
            font-weight: bold;
            text-decoration: none;
            color: #337ab7;
        }
    </style>
</head>
<body>
<?php SiteHeader::render($site_properties); ?>
<div id="MasterContainer">
  <div id="BodyWrapper"><div id="RepositionBody"><div id="Body" style="width:970px">

    <div class="tab-container">
      <div class="tab tab-active active" data-id="best_friends_tab">Best Friends</div>
      <div class="tab" data-id="friends_tab">Friends</div>
      <div class="tab" data-id="followers_tab">Followers</div>
      <div class="tab" data-id="following_tab">Following</div>
      <div class="tab" data-id="requests_tab">Requests</div>
    </div>

    <div id="best_friends_tab" class="tab-content active">
        <?php if (count($bestFriends) === 0): ?>
            <p>No best friends found.</p>
        <?php else: ?>
            <?php foreach ($bestFriends as $bf): ?>
                <div class="friend-entry"><a href="/User.aspx?ID=<?= $bf['id'] ?>"><?= htmlspecialchars($bf['username']) ?></a></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="friends_tab" class="tab-content">
        <?php if (count($friends) === 0): ?>
            <p>No friends found.</p>
        <?php else: ?>
            <?php foreach ($friends as $f): ?>
                <div class="friend-entry"><a href="/User.aspx?ID=<?= $f['id'] ?>"><?= htmlspecialchars($f['username']) ?></a></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="followers_tab" class="tab-content">
        <p>This Tab Is WIP</p>
    </div>

    <div id="following_tab" class="tab-content">
        <p>This Tab Is WIP</p>
    </div>

    <div id="requests_tab" class="tab-content">
        <?php if (count($requests) === 0): ?>
            <p>No friend requests.</p>
        <?php else: ?>
            <form method="POST" style="margin:0;">
            <?php foreach ($requests as $req): ?>
                <div class="friend-entry" style="display:flex; align-items:center; justify-content: space-between; max-width:400px;">
                    <a href="/User.aspx?ID=<?= $req['id'] ?>"><?= htmlspecialchars($req['username']) ?></a>
                    <div>
                        <button type="submit" name="acceptRequestId" value="<?= $req['RequestID'] ?>" class="btn-accept">Accept</button>
                        <button type="submit" name="declineRequestId" value="<?= $req['RequestID'] ?>" class="btn-decline">Decline</button>
                    </div>
                </div>
            <?php endforeach; ?>
            </form>
        <?php endif; ?>
    </div>

<script>
const tabs = document.querySelectorAll('.tab-container .tab');
const contents = document.querySelectorAll('.tab-content');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.className = 'tab');
        tab.className = 'tab tab-active active';
        const id = tab.getAttribute('data-id');
        contents.forEach(c => {
            c.classList.toggle('active', c.id === id);
        });
    });
});
</script>

  </div></div></div>
</div>
</body>
</html>
