<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

$forum_id = isset($_GET['ForumID']) ? intval($_GET['ForumID']) : 0;

if ($forum_id === 0) {
    header("Location: /Forum/Default.aspx");
    exit();
}

// Fetch forum details along with its group
$stmt = $conn->prepare('SELECT f.id, f.name, f.description, f.group_id, fg.name as group_name FROM forums f JOIN forum_groups fg ON f.group_id = fg.id WHERE f.id = :id');
$stmt->execute(['id' => $forum_id]);
$forum = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$forum) {
    die('Forum not found.');
}

// Fetch threads for this forum
// For now, we will just fetch them. Later we can add pagination.
$threads_stmt = $conn->prepare('SELECT t.id, t.subject, t.user_id, u.username as author_name, t.replies_count, t.views_count, t.last_post_at, t.is_pinned, t.is_locked, t.is_popular, lp.username as last_poster_name FROM threads t JOIN users u ON t.user_id = u.id LEFT JOIN users lp ON t.last_post_user_id = lp.id WHERE t.forum_id = :forum_id ORDER BY t.is_pinned DESC, t.last_post_at DESC');
$threads_stmt->execute(['forum_id' => $forum_id]);
$threads = $threads_stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">

<head>
    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___d0a32d7530b30a6f5d85fd297f8b6898_m.css' />
</head>

<body>
    <div id="BodyWrapper">
        <div id="RepositionBody">
            <?= SiteHeader::render() ?>
            <div class="forceSpace">&nbsp;</div>

            <div id="Body" style="width:970px;">
                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr valign="top">
                    <tr>
                        <td align="left"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1" name="Whereami1">
                                <div>
                                    <nobr>
                                        <a class="linkMenuSink notranslate" href="/Forum/Default.aspx.php">ROBLOX Forum</a>
                                    </nobr>
                                    <nobr>
                                        <span class="normalTextSmallBold"> » </span>
                                        <a class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx.php?ForumGroupID=<?= $forum['group_id'] ?>"><?= htmlspecialchars($forum['group_name']) ?></a>
                                    </nobr>
                                    <nobr>
                                        <span class="normalTextSmallBold"> » </span>
                                        <a class="linkMenuSink notranslate" href="/Forum/ShowForum.aspx.php?ForumID=<?= $forum['id'] ?>"><?= htmlspecialchars($forum['name']) ?></a>
                                    </nobr>
                                </div>
                            </span></td>
                        <td align="right"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1">

                                <div id="forum-nav" style="text-align: right">
                                    <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
                                    <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>







                                </div>
                            </span></td>
                    </tr>
                    <td class="LeftColumn">&nbsp;</td>
                    <td id="ctl00_cphRoblox_CenterColumn" class="CenterColumn">
                        <br>
                        <tr style="padding-bottom:5px;">
                            <td valign="bottom" align="left">
                                <a id="ctl00_cphRoblox_ThreadView1_ctl00_NewThreadLinkTop" class="btn-control btn-control-medium verified-email-act" href="/Forum/AddPost.aspx.php?ForumID=<?= $forum_id ?>">
                                    New Thread<span class="btn-text">New Thread</span>
                                </a>
                            </td>
                            <td align="right">
                                <span class="normalTextSmallBold">Search this forum: </span>
                                <input name="ctl00$cphRoblox$ThreadView1$ctl00$Search" type="text" id="ctl00_cphRoblox_ThreadView1_ctl00_Search">
                                <input type="submit" name="ctl00$cphRoblox$ThreadView1$ctl00$SearchButton" value=" Go " id="ctl00_cphRoblox_ThreadView1_ctl00_SearchButton" class="translate btn-control btn-control-medium forum-btn-control-medium">
                            </td>
                        </tr>
                        <table class="table" width="100%" cellpadding="2" cellspacing="1" border="0">
                            <div style="height:7px;"></div>
                            <tr class="table-header forum-table-header">
                                <th class="first" colspan="2" width="55%">&nbsp;Subject</th>
                                <th style="width:15%;" align="center">Author</th>
                                <th style="width:5%;" align="center">Replies</th>
                                <th style="width:5%;" align="center">Views</th>
                                <th style="width:20%;" align="center">Last Post&nbsp;</th>
                            </tr>
                            <?php if (empty($threads)): ?>
                                <tr class="forum-table-row">
                                    <td colspan="6" align="center"><span class="normalTextSmaller">No threads found in this forum.</span></td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($threads as $thread): ?>
                                    <tr class="forum-table-row">
                                        <?php
                                        $icon_name = 'thread'; // Default icon
                                        if ($thread['is_locked']) {
                                            $icon_name = 'locked';
                                        } elseif ($thread['is_popular']) {
                                            $icon_name = 'popular';
                                        }

                                        // For now, assume all are unread. This will be dynamic later.
                                        $read_status = 'unread';
                                        // Pinned threads have special icons that override others
                                        if ($thread['is_pinned']) {
                                            if ($thread['is_locked']) {
                                                $icon_name = 'pinned-locked';
                                            } else {
                                                // No specific icon for just pinned, so use a default but it will be sorted to the top.
                                                // We could potentially find a generic pin icon later.
                                                $icon_name = 'thread';
                                            }
                                        }

                                        $icon_path = "/images/Forums/{$icon_name}-{$read_status}.png";
                                        ?>
                                        <td align="center" width="25px">
                                            <img src="<?php echo $icon_path; ?>" alt="Post">
                                        </td>
                                        <td>
                                            <a class="forum-summary" href="/Forum/ShowPost.aspx?id=<?php echo $thread['id']; ?>"><?php echo htmlspecialchars($thread['subject']); ?></a>
                                        </td>
                                        <td class="forum-centered-cell" align="center">
                                            <a class="normalTextSmaller" href="/User.aspx?ID=<?php echo $thread['user_id']; ?>"><?php echo htmlspecialchars($thread['author_name']); ?></a>
                                        </td>
                                        <td class="forum-centered-cell" align="center"><span class="normalTextSmaller"><?php echo number_format($thread['replies_count']); ?></span></td>
                                        <td class="forum-centered-cell" align="center"><span class="normalTextSmaller"><?php echo number_format($thread['views_count']); ?></span></td>
                                        <td align="center">
                                            <?php if ($thread['last_post_at']): ?>
                                                <div class="normalTextSmaller">
                                                    <a href="/Forum/ShowPost.aspx?id=<?php echo $thread['id']; ?>#last"><?php echo date('n/j/Y g:i A', strtotime($thread['last_post_at'])); ?></a>
                                                    <br />
                                                    by <a href="#"><?php echo htmlspecialchars($thread['last_poster_name'] ?? 'N/A'); ?></a>
                                                </div>
                                            <?php else: ?>
                                                <span class="normalTextSmaller">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </table>
                    </td>
                    </tr>
                    </tbody>
                </table>
                </td>
                <td class="RightColumn">&nbsp;</td>
                </tr>
                </table>
            </div>
            <?= SiteFooter::render() ?>
        </div>
    </div>
</body>

</html>
