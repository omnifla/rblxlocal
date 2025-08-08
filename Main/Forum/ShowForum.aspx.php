<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Web\SiteAlert;
$forum_id = isset($_GET['ForumID']) ? intval($_GET['ForumID']) : 0;
if ($forum_id === 0) {
    header("Location: /Forum/Default.aspx");
    exit();
}
$days = isset($_GET['days']) ? intval($_GET['days']) : 0;
$threads_per_page = 20;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $threads_per_page;
$stmt = $conn->prepare("SELECT f.id, f.name, f.description, f.group_id, fg.name as group_name FROM forums f JOIN forum_groups fg ON f.group_id = fg.id WHERE f.id = :id");
$stmt->execute(['id' => $forum_id]);
$forum = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$forum) {
    header("Location: /Forum/Default.aspx");
    exit();
}
$where_clause = "WHERE t.forum_id = :forum_id";
$params = ['forum_id' => $forum_id];
if ($days > 0) {
    $where_clause .= " AND t.last_post_at >= NOW() - INTERVAL :days DAY";
    $params['days'] = $days;
}
$count_stmt = $conn->prepare("SELECT COUNT(*) FROM threads t $where_clause");
$count_stmt->execute($params);
$total_threads = $count_stmt->fetchColumn();
$total_pages = max(1, ceil($total_threads / $threads_per_page));
$sql = "SELECT t.id, t.subject, t.user_id, u.username as author_name, t.replies_count, t.views_count, t.last_post_at, t.is_pinned, t.is_locked, t.is_popular, lp.username as last_poster_name FROM threads t JOIN users u ON t.user_id = u.id LEFT JOIN users lp ON t.last_post_user_id = lp.id $where_clause ORDER BY t.is_pinned DESC, t.last_post_at DESC LIMIT :limit OFFSET :offset";
$threads_stmt = $conn->prepare($sql);
foreach ($params as $key => $val) {
    $threads_stmt->bindValue(":$key", $val, PDO::PARAM_INT);
}
$threads_stmt->bindValue(":limit", $threads_per_page, PDO::PARAM_INT);
$threads_stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
$threads_stmt->execute();
$threads = $threads_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($site_properties['Title']) ?>.com</title>
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css" />
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___d0a32d7530b30a6f5d85fd297f8b6898_m.css" />
    <link rel="stylesheet" href="/Forum/skins/default/style/default.css" type="text/css" />
</head>
<body>
<div id="BodyWrapper">
    <div id="RepositionBody">
        <?= SiteHeader::render() ?>
        <?= SiteAlert::render() ?>

        <div id="Body" style="width:970px;">
            <table width="100%">
                <tr>
                    <td align="left">
                        <div>
                            <a class="linkMenuSink" href="/Forum/Default.aspx">ROBLOX Forum</a>
                            » <a class="linkMenuSink" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?= $forum['group_id'] ?>"><?= htmlspecialchars($forum['group_name']) ?></a>
                            » <a class="linkMenuSink" href="/Forum/ShowForum.aspx?ForumID=<?= $forum['id'] ?>"><?= htmlspecialchars($forum['name']) ?></a>
                        </div>
                    </td>
                    <td align="right">
                        <div id="forum-nav">
                            <a href="/Forum/Default.aspx">Home</a>
                            <a href="/Forum/Search/default.aspx">Search</a>
                        </div>
                    </td>
                </tr>
            </table>

            <div style="margin:10px 0;">
                <a class="btn-control" href="/Forum/AddPost.aspx.php?ForumID=<?= $forum_id ?>">New Thread</a>

                <form method="GET" action="" style="display:inline-block; float:right;">
                    <input type="hidden" name="ForumID" value="<?= $forum_id ?>">
                    <span>Display threads for: </span>
                    <select name="days" onchange="this.form.submit()">
                        <?php
                        $options = [0 => 'All Days', 1 => 'Today', 3 => 'Past 3 Days', 7 => 'Past Week', 14 => 'Past 2 Weeks', 30 => 'Past Month', 90 => 'Past 3 Months', 180 => 'Past 6 Months', 360 => 'Past Year'];
                        foreach ($options as $val => $label) {
                            $selected = ($val == $days) ? 'selected' : '';
                            echo "<option value='$val' $selected>$label</option>";
                        }
                        ?>
                    </select>
                </form>
            </div>

            <table class="tableBorder" style="width:100%;">
                <tr class="forum-table-header">
                    <th colspan="3">Subject</th>
                    <th>Author</th>
                    <th>Replies</th>
                    <th>Views</th>
                    <th>Last Post</th>
                </tr>

                <?php if (empty($threads)): ?>
                    <tr><td colspan="7" align="center">No threads found.</td></tr>
                <?php else: ?>
                    <?php foreach ($threads as $thread):
                        $icon_name = 'thread';
                        if ($thread['is_locked']) $icon_name = 'locked';
                        elseif ($thread['is_popular']) $icon_name = 'popular';
                        if ($thread['is_pinned']) $icon_name = $thread['is_locked'] ? 'pinned-locked' : 'thread';
                        ?>
                        <tr>
                            <td style="width:25px;"><img src="/images/Forums/<?= $icon_name ?>-unread.png"></td>
                            <td><a href="/Forum/ShowPost.aspx?PostID=<?= $thread['id'] ?>"><?= htmlspecialchars($thread['subject']) ?></a></td>
                            <td style="width:90px;"></td>
                            <td><a href="/User.aspx?ID=<?= $thread['user_id'] ?>"><?= htmlspecialchars($thread['author_name']) ?></a></td>
                            <td align="center"><?= number_format($thread['replies_count']) ?></td>
                            <td align="center"><?= number_format($thread['views_count']) ?></td>
                            <td align="center">
                                <a href="/Forum/ShowPost.aspx?PostID=<?= $thread['id'] ?>#last">
                                    <b><?= date('n/j/Y g:i A', strtotime($thread['last_post_at'])) ?></b><br>
                                    <?= htmlspecialchars($thread['last_poster_name'] ?? 'N/A') ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
            <div style="margin-top:10px; text-align:center;">
                <?php if ($page > 1): ?>
                    <a href="?ForumID=<?= $forum_id ?>&days=<?= $days ?>&page=<?= $page - 1 ?>">Prev</a>
                <?php endif; ?>
                Page <?= $page ?> of <?= $total_pages ?>
                <?php if ($page < $total_pages): ?>
                    <a href="?ForumID=<?= $forum_id ?>&days=<?= $days ?>&page=<?= $page + 1 ?>">Next</a>
                <?php endif; ?>
            </div>
        </div>

        <?= SiteFooter::render() ?>
    </div>
</div>
</body>
</html>
