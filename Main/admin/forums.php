<?php
// written by denied_id

// admin/forums.php - Forums management page

include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Admin\AdminHelper;

// Check if user is authenticated and has admin privileges
AdminHelper::requireAdmin();
$current_user = Auth::GetAuthenticatedUser();

// Get all forum groups with their forums
$forum_groups_stmt = $conn->prepare("
    SELECT fg.id, fg.name, fg.sort_order,
           COUNT(f.id) as forum_count
    FROM forum_groups fg
    LEFT JOIN forums f ON fg.id = f.group_id
    GROUP BY fg.id, fg.name, fg.sort_order
    ORDER BY fg.sort_order ASC, fg.name ASC
");
$forum_groups_stmt->execute();
$forum_groups = $forum_groups_stmt->fetchAll(PDO::FETCH_ASSOC);

// Get all forums with their group information
$forums_stmt = $conn->prepare("
    SELECT f.id, f.name, f.description, f.threads_count, f.posts_count, f.sort_order,
           fg.name as group_name, fg.id as group_id
    FROM forums f
    JOIN forum_groups fg ON f.group_id = fg.id
    ORDER BY fg.sort_order ASC, f.sort_order ASC, f.name ASC
");
$forums_stmt->execute();
$forums = $forums_stmt->fetchAll(PDO::FETCH_ASSOC);

// Page setup
$page_title = "Admin Panel - Forums Management";

// Include the header
SiteHeader::render(["pageTitle" => $page_title]);
?>

<head>
    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___d0a32d7530b30a6f5d85fd297f8b6898_m.css' />
    <link rel='stylesheet' href='/Forum/skins/default/style/default.css' />
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
                                                            <a class="linkMenuSink notranslate" href="/admin">Admin Panel</a>
                                                        </nobr>
                                                        <nobr>
                                                            <span class="normalTextSmallBold"> » </span>
                                                            <span class="normalTextSmallBold">Forums Management</span>
                                                        </nobr>
                                                    </div>
                                                </span>
                                            </td>
                                            <td align="right">
                                                <span>
                                                    <div id="forum-nav" style="text-align: right; font-size: 14px">
                                                        <a class="menuTextLink first" href="/Forum/Default.aspx.php">Home</a>
                                                        <a class="menuTextLink" href="/admin">Admin</a>
                                                    </div>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">
                                                <h2 style="margin-bottom:20px">Admin Panel</h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table cellpadding="0" cellspacing="0" border="0" style="width:100%; margin-bottom: 20px;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding: 10px; text-align: center;">
                                                                <a href="/admin" class="btn-control btn-control-medium forum-btn-control-medium" style="margin-right: 10px;">User Management</a>
                                                                <a href="/admin/forums" class="btn-control btn-control-medium forum-btn-control-medium">Forums Management</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">
                                                <h3 style="margin-bottom:15px">Forum Groups</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%; margin-bottom: 20px;">
                                                    <tbody>
                                                        <!-- Forum Groups Header -->
                                                        <tr>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">ID</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Group Name</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Sort Order</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Forums Count</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Actions</span>
                                                            </td>
                                                        </tr>

                                                        <!-- Forum Groups Rows -->
                                                        <?php foreach ($forum_groups as $index => $group) : ?>
                                                            <tr class="<?= $index % 2 == 0 ? 'forum-content-background' : 'forum-content-background-alternate' ?>">
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= $group['id'] ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <a href="/admin/forum-group?id=<?= $group['id'] ?>" class="linkSmallBold"><?= htmlspecialchars($group['name']) ?></a>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= $group['sort_order'] ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= $group['forum_count'] ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <a href="/admin/forum-group?id=<?= $group['id'] ?>" class="linkSmall">Edit</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">
                                                <h3 style="margin-bottom:15px">Forums</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
                                                    <tbody>
                                                        <!-- Forums Header -->
                                                        <tr>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">ID</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Forum Name</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Group</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Description</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Threads</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Posts</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Sort</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Actions</span>
                                                            </td>
                                                        </tr>

                                                        <!-- Forums Rows -->
                                                        <?php foreach ($forums as $index => $forum) : ?>
                                                            <tr class="<?= $index % 2 == 0 ? 'forum-content-background' : 'forum-content-background-alternate' ?>">
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= $forum['id'] ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <a href="/admin/forum?id=<?= $forum['id'] ?>" class="linkSmallBold"><?= htmlspecialchars($forum['name']) ?></a>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= htmlspecialchars($forum['group_name']) ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= htmlspecialchars(substr($forum['description'] ?? '', 0, 50)) ?><?= strlen($forum['description'] ?? '') > 50 ? '...' : '' ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= number_format($forum['threads_count']) ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= number_format($forum['posts_count']) ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= $forum['sort_order'] ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <a href="/admin/forum?id=<?= $forum['id'] ?>" class="linkSmall">Edit</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="left" colspan="2">
                                                <span class="normalTextSmall">
                                                    Total Forum Groups: <?= count($forum_groups) ?> | 
                                                    Total Forums: <?= count($forums) ?>
                                                </span>
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
        </div>
    </div>

    <?= SiteFooter::render() ?>
</body>

</html>
