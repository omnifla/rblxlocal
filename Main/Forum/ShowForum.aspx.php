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

$stmt = $conn->prepare('SELECT f.id, f.name, f.description, f.group_id, fg.name as group_name FROM forums f JOIN forum_groups fg ON f.group_id = fg.id WHERE f.id = :id');
$stmt->execute(['id' => $forum_id]);
$forum = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$forum) {
    die('Forum not found.');
}

$threads_stmt = $conn->prepare('SELECT t.id, t.subject, t.user_id, u.username as author_name, t.replies_count, t.views_count, t.last_post_at, t.is_pinned, t.is_locked, t.is_popular, lp.username as last_poster_name FROM threads t JOIN users u ON t.user_id = u.id LEFT JOIN users lp ON t.last_post_user_id = lp.id WHERE t.forum_id = :forum_id ORDER BY t.is_pinned DESC, t.last_post_at DESC');
$threads_stmt->execute(['forum_id' => $forum_id]);
$threads = $threads_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css" />
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___d0a32d7530b30a6f5d85fd297f8b6898_m.css" />
    <link rel="stylesheet" href="/Forum/skins/default/style/default.css" type="text/css" />
</head>
<body>
    <div id="BodyWrapper">
        <div id="RepositionBody">
            <?= SiteHeader::render() ?>
            <?= SiteAlert::render() ?>
            <div class="forceSpace">&nbsp;</div>
            <div id="Body" style="width:970px;">
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td align="left">
                            <span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1">
                                <div>
                                    <nobr><a class="linkMenuSink notranslate" href="/Forum/Default.aspx.php">ROBLOX Forum</a></nobr>
                                    <nobr><span class="normalTextSmallBold"> » </span><a class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx.php?ForumGroupID=<?= $forum['group_id'] ?>"><?= htmlspecialchars($forum['group_name']) ?></a></nobr>
                                    <nobr><span class="normalTextSmallBold"> » </span><a class="linkMenuSink notranslate" href="/Forum/ShowForum.aspx.php?ForumID=<?= $forum['id'] ?>"><?= htmlspecialchars($forum['name']) ?></a></nobr>
                                </div>
                            </span>
                        </td>
                        <td align="right">
                            <div id="forum-nav" style="text-align: right">
                                <a class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
                                <a class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="LeftColumn">&nbsp;</td>
                        <td class="CenterColumn">
                            <br>
                            <tr>
                                <td valign="bottom" align="left">
                                    <a class="btn-control btn-control-medium verified-email-act" href="/Forum/AddPost.aspx.php?ForumID=<?= $forum_id ?>">
                                        New Thread<span class="btn-text">New Thread</span>
                                    </a>
                                </td>
                                <td align="right">
                                    <span class="normalTextSmallBold">Search this forum: </span>
                                    <input type="text" id="ctl00_cphRoblox_ThreadView1_ctl00_Search">
                                    <input type="submit" value=" Go " class="translate btn-control btn-control-medium forum-btn-control-medium">
                                </td>
                            </tr>
                            <table class="tableBorder" cellspacing="1" cellpadding="3" border="0" style="width:100%;">
                                <tr class="forum-table-header">
                                    <th align="left" colspan="3">&nbsp;Subject&nbsp;</th>
                                    <th align="left">&nbsp;Author&nbsp;</th>
                                    <th align="center">&nbsp;Replies&nbsp;</th>
                                    <th align="center">&nbsp;Views&nbsp;</th>
                                    <th align="center">&nbsp;Last Post&nbsp;</th>
                                </tr>
                                <?php if (empty($threads)): ?>
                                    <tr class="forum-table-row">
                                        <td colspan="6" align="center"><span class="normalTextSmaller">No threads found in this forum.</span></td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($threads as $thread): ?>
                                        <?php
                                            $icon_name = 'thread';
                                            if ($thread['is_locked']) {
                                                $icon_name = 'locked';
                                            } elseif ($thread['is_popular']) {
                                                $icon_name = 'popular';
                                            }
                                            $read_status = 'unread';
                                            if ($thread['is_pinned']) {
                                                if ($thread['is_locked']) {
                                                    $icon_name = 'pinned-locked';
                                                } else {
                                                    $icon_name = 'thread';
                                                }
                                            }
                                        ?>
                                        <tr class="forum-table-row">
                                            <td align="center" valign="middle" style="width:25px;">
                                                <img title="Popular post (Not Read)" src="/images/Forums/<?= $icon_name ?>-<?= $read_status ?>.png" style="border-width:0px;">
                                            </td>
                                            <td class="notranslate" style="height:25px;">
                                                <a class="post-list-subject" href="/Forum/ShowPost.aspx?PostID=<?= $thread['id'] ?>">
                                                    <div class="thread-link-outer-wrapper">
                                                        <div class="thread-link-container notranslate"><?= htmlspecialchars($thread['subject']) ?></div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="notranslate" style="width:90px;padding-right:12px;"></td>
                                            <td align="left" style="width:100px;">
                                                <a class="post-list-author notranslate" href="/User.aspx?ID=<?= $thread['user_id'] ?>">
                                                    <div class="thread-link-outer-wrapper">
                                                        <div class="normalTextSmaller thread-link-container"><?= htmlspecialchars($thread['author_name']) ?></div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td align="center" style="width:50px;"><span class="normalTextSmaller"><?= number_format($thread['replies_count']) ?></span></td>
                                            <td align="center" style="width:50px;"><span class="normalTextSmaller"><?= number_format($thread['views_count']) ?></span></td>
                                            <td align="center" style="width:100px;white-space:nowrap;">
                                                <a class="last-post" href="/Forum/ShowPost.aspx?PostID=<?= $thread['id'] ?>#last">
                                                    <div><span class="normalTextSmaller"><b><?= date('n/j/Y g:i A', strtotime($thread['last_post_at'])) ?></b></span></div>
                                                    <div class="normalTextSmaller notranslate"><?= htmlspecialchars($thread['last_poster_name'] ?? 'N/A') ?></div>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                <tr class="forum-table-footer">
                                    <td colspan="7">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td class="RightColumn">&nbsp;</td>
                            <iframe allowtransparency="true" frameborder="0" height="612" scrolling="no" src="/userads/2" width="160" data-js-adtype="iframead"></iframe>
                        </td>
                    </tr>
                </table>
            </div>
            <?= SiteFooter::render() ?>
        </div>
    </div>
</body>
</html>
