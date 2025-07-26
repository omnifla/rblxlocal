<?php 
// written by denied_id

// ShowPost.aspx.php

// Include necessary files
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

/**
 * Basic sanitization for forum post HTML. Removes any <script> tags and their content
 * to protect against malicious injections while still allowing safe HTML tags
 * that users previewed when creating their post.
 *
 * @param string $html Raw HTML from database
 * @return string Sanitized HTML safe for output
 */
function sanitize_forum_html($html) {
    // Remove <script> tags and their content (case-insensitive, multi-line)
    return preg_replace('#<script\b[^>]*>(.*?)</script>#is', '', $html);
}


// Get thread ID from URL
$thread_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($thread_id === 0) {
    header("Location: /Forum/");
    exit;
}

// Fetch thread info for breadcrumbs and title
$thread_stmt = $conn->prepare("SELECT t.subject, t.forum_id, f.name as forum_name, f.group_id as forum_group_id, fg.name as forum_group_name FROM threads t JOIN forums f ON t.forum_id = f.id JOIN forum_groups fg ON f.group_id = fg.id WHERE t.id = :thread_id");
$thread_stmt->execute(['thread_id' => $thread_id]);
$thread = $thread_stmt->fetch(PDO::FETCH_ASSOC);

if (!$thread) {
    // Thread not found, redirect to forum index
    header("Location: /Forum/");
    exit;
}

// Increment view count
$update_views_stmt = $conn->prepare("UPDATE threads SET views_count = views_count + 1 WHERE id = :thread_id");
$update_views_stmt->execute(['thread_id' => $thread_id]);

// Sorting setup
$sort_order = isset($_GET['sort']) && $_GET['sort'] === 'newest' ? 'DESC' : 'ASC';
$sort_param = $sort_order === 'DESC' ? 'newest' : 'oldest';

// Pagination setup
$posts_per_page = 10;
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($current_page - 1) * $posts_per_page;

// Get total post count for pagination
$count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM posts WHERE thread_id = :thread_id");
$count_stmt->execute(['thread_id' => $thread_id]);
$total_posts = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];
$total_pages = ceil($total_posts / $posts_per_page);

// Fetch posts for the thread, joining with users to get author info
$posts_stmt = $conn->prepare("
    SELECT p.id, p.content as body, p.created_at, u.id as user_id, u.username, u.post_count, u.created_at as join_date
    FROM posts p
    JOIN users u ON p.user_id = u.id
    WHERE p.thread_id = :thread_id
    ORDER BY p.created_at $sort_order
    LIMIT :limit OFFSET :offset
");
$posts_stmt->bindValue(':thread_id', $thread_id, PDO::PARAM_INT);
$posts_stmt->bindValue(':limit', $posts_per_page, PDO::PARAM_INT);
$posts_stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$posts_stmt->execute();
$posts = $posts_stmt->fetchAll(PDO::FETCH_ASSOC);

// Page setup
$page_title = htmlspecialchars($thread['subject']);

// now we can include the header
SiteHeader::render(["pageTitle" => $page_title]);
?>

<head>
    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___d0a32d7530b30a6f5d85fd297f8b6898_m.css' />
    <link rel='stylesheet' href='/Forum/skins/default/style/default.css' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <div id="BodyWrapper">
        <div id="RepositionBody">
            <?= SiteHeader::render() ?>
            <div class="forceSpace">&nbsp;</div>
            <div id="Body" style="width:970px;">
                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr valign="top">
                            <td>&nbsp;&nbsp;&nbsp;</td>
                            <td id="ctl00_cphRoblox_CenterColumn" width="95%" class="CenterColumn">
                                <br>
                                <table cellpadding="0" width="100%">
                                    <tbody>
                                        <tr>
                                            <td align="left">
                                                <span name="Whereami1">
                                                    <div>
                                                        <nobr>
                                                            <a class="linkMenuSink notranslate" href="/Forum/Default.aspx.php">ROBLOX Forum</a>
                                                        </nobr>
                                                        <nobr>
                                                            <span class="normalTextSmallBold"> » </span>
                                                            <a class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx.php?ForumGroupID=<?= $thread['forum_group_id'] ?>"><?= htmlspecialchars($thread['forum_group_name']) ?></a>
                                                        </nobr>
                                                        <nobr>
                                                            <span class="normalTextSmallBold"> » </span>
                                                            <a class="linkMenuSink notranslate" href="/Forum/ShowForum.aspx.php?ForumID=<?= $thread['forum_id'] ?>"><?= htmlspecialchars($thread['forum_name']) ?></a>
                                                        </nobr>
                                                    </div>
                                                </span>
                                            </td>
                                            <td align="right">
                                                <span>
                                                    <div id="forum-nav" style="text-align: right; font-size: 14px">
                                                        <a class="menuTextLink first" href="/Forum/Default.aspx.php">Home</a>
                                                        <a class="menuTextLink" href="/Forum/Search/default.aspx.php">Search</a>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">
                                                <h2 style="margin-bottom:20px"><?= htmlspecialchars($thread['subject']) ?></h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="middle" align="left">
                                                <span class="normalTextSmallBold"></span>
                                            </td>
                                            <td valign="middle" align="right">
                                                <form method="get" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $thread_id ?>">
                                                    <?php if (isset($_GET['page']) && $_GET['page'] > 1): ?>
                                                        <input type="hidden" name="page" value="<?= $_GET['page'] ?>">
                                                    <?php endif; ?>
                                                    <span class="normalTextSmallBold">Sort: </span>
                                                    <select name="sort" onchange="this.form.submit()" style="margin-bottom:5px;">
                                                        <option value="oldest" <?= $sort_param === 'oldest' ? 'selected' : '' ?>>Oldest to newest</option>
                                                        <option value="newest" <?= $sort_param === 'newest' ? 'selected' : '' ?>>Newest to oldest</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
                                                    <tbody>

                                        <?php foreach ($posts as $index => $post) : ?>
                                            <tr class="forum-post">
                                                <td class="forum-content-background" valign="top" style="width:150px;white-space:nowrap;">
                                                    <table border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td><b><a class="normalTextSmallBold notranslate" href="/User.php?id=<?= $post['user_id'] ?>"><?= htmlspecialchars($post['username']) ?></a></b><br></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="/User.php?id=<?= $post['user_id'] ?>" style="width:100px;height:100px;position:relative;"><img src="/Images/Placeholder1024x1024.png" style="border-width:0px;width:100px;height:100px;"></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="normalTextSmaller"><b>Joined:</b> <?= date("d M Y", strtotime($post['join_date'])) ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="normalTextSmaller"><b>Total Posts:</b> <?= number_format($post['post_count']) ?></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td class="forum-content-background" valign="top">
                                                    <table cellspacing="0" cellpadding="3" border="0" style="width:100%;border-collapse:collapse;table-layout:fixed;overflow:hidden;word-wrap:break-word;">
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="2"><span class="normalTextSmaller"><?= date("d M Y h:i A", strtotime($post['created_at'])) ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" colspan="2" style="height:125px;"><span class="normalTextSmall notranslate"><?= nl2br(sanitize_forum_html($post['body'])) ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"><span class="normalTextSmaller notranslate"></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="height:2px;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="left" style="height:29px;"></td>
                                                                <td align="right">
                                                                    <span class="post-response-options">
                                                                        <span class="ReportAbuse">
                                                                            <span class="AbuseButton">
                                                                                <a href="#" class="linkSmallBold" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Report Abuse</a>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <br>
                                                <span>
                                                    <table cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
                                                        <tbody>
                                                            <tr>
                                                                <td><span class="normalTextSmallBold">Page <?= $current_page ?> of <?= $total_pages ?></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="middle" colspan="2">
                                                <div style="text-align: center; margin: 10px 0;">
                                                    <?php if ($total_pages > 1): ?>
                                                        <?php 
                                                        $sort_query = isset($_GET['sort']) ? '&sort=' . urlencode($_GET['sort']) : '';
                                                        ?>
                                                        <?php if ($current_page > 1): ?>
                                                            <a href="?id=<?= $thread_id ?>&page=1<?= $sort_query ?>" class="pager first"></a>
                                                            <a href="?id=<?= $thread_id ?>&page=<?= $current_page - 1 ?><?= $sort_query ?>" class="pager previous"></a>
                                                        <?php else: ?>
                                                            <span class="pager previous disabled"></span>
                                                        <?php endif; ?>
                                                        
                                                        <span class="page text">Page <?= $current_page ?> of <?= $total_pages ?></span>
                                                        
                                                        <?php if ($current_page < $total_pages): ?>
                                                            <a href="?id=<?= $thread_id ?>&page=<?= $current_page + 1 ?><?= $sort_query ?>" class="pager next"></a>
                                                            <a href="?id=<?= $thread_id ?>&page=<?= $total_pages ?><?= $sort_query ?>" class="pager last"></a>
                                                        <?php else: ?>
                                                            <span class="pager next disabled"></span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <?= SiteFooter::render() ?>
        </div>
    </div>
</body>
