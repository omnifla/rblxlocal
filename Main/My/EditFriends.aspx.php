<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteAlert;
$user = Auth::GetAuthenticatedUserInfo();
$userId = (int) $user["id"];

$db = $conn;

function fetchUsersByStatus(PDO $db, int $userId, string $type): array
{
    switch ($type) {

        case 'best':
            $stmt = $db->prepare("
        SELECT
            u.id,
            u.username
        FROM friends f
        JOIN users u
            ON (
                (f.fromid = u.id AND f.toid = :uid)
                OR
                (f.toid = u.id AND f.fromid = :uid)
            )
        WHERE
            f.status = 2
            AND f.bestfriend = TRUE
    ");

            $stmt->execute([
                ':uid' => $userId
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        case 'friends':
            $stmt = $db->prepare("
                SELECT u.id, u.username
                FROM friends f
                JOIN users u
                    ON (
                        (f.fromid = u.id AND f.toid = :uid)
                        OR
                        (f.toid = u.id AND f.fromid = :uid)
                    )
                WHERE f.status = 2
            ");
            $stmt->execute([':uid' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        case 'requests':
            $stmt = $db->prepare("
        SELECT
            f.fromid AS RequestID,
            u.id,
            u.username
        FROM friends f
        JOIN users u ON u.id = f.fromid
        WHERE
            f.toid = :uid
            AND f.status = 1
    ");

            $stmt->execute([
                ':uid' => $userId
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        case 'followers':
        case 'following':
        default:
            return [];
    }
}

$bestFriends = fetchUsersByStatus($db, $userId, 'best');
$friends = fetchUsersByStatus($db, $userId, 'friends');
$followers = fetchUsersByStatus($db, $userId, 'followers');
$following = fetchUsersByStatus($db, $userId, 'following');
$requests = fetchUsersByStatus($db, $userId, 'requests');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acceptRequestId'])) {
        $requestId = intval($_POST['acceptRequestId']);
        $update = $db->prepare("UPDATE friends SET status = 2 WHERE fromid = :rid AND toid = :uid");
        $update->execute([':rid' => $requestId, ':uid' => $userId]);
        header("Location: /My/EditFriends.aspx");
        exit;
    }
    if (isset($_POST['declineRequestId'])) {
        $requestId = (int) $_POST['declineRequestId'];

        $delete = $db->prepare("
        DELETE FROM friends
        WHERE fromid = :rid
          AND toid = :uid
          AND status = 1
    ");

        $delete->execute([
            ':rid' => $requestId,
            ':uid' => $userId
        ]);

        header("Location: /My/EditFriends.aspx");
        exit;
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Friends - Roblox</title>
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

        .tab-active,
        .active {
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
    <?php SiteHeader::render(); ?>
    <?= SiteAlert::render() ?>
    <div id="MasterContainer">
        <div id="BodyWrapper">
            <div id="RepositionBody">
                <div id="Body" style="width:970px">

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
                                <div class="friend-entry"><a
                                        href="/User.aspx?ID=<?= $bf['id'] ?>"><?= htmlspecialchars($bf['username']) ?></a></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div id="friends_tab" class="tab-content">
                        <?php if (count($friends) === 0): ?>
                            <p>No friends found.</p>
                        <?php else: ?>
                            <?php foreach ($friends as $f): ?>
                                <div class="friend-entry"><a
                                        href="/User.aspx?ID=<?= $f['id'] ?>"><?= htmlspecialchars($f['username']) ?></a></div>
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
                                    <div class="friend-entry"
                                        style="display:flex; align-items:center; justify-content: space-between; max-width:400px;">
                                        <a href="/User.aspx?ID=<?= $req['id'] ?>"><?= htmlspecialchars($req['username']) ?></a>
                                        <div>
                                            <button type="submit" name="acceptRequestId" value="<?= $req['requestid'] ?>"
                                                class="btn-accept">Accept</button>
                                            <button type="submit" name="declineRequestId" value="<?= $req['requestid'] ?>"
                                                class="btn-decline">Decline</button>
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

                </div>
            </div>
        </div>
    </div>
</body>

</html>
