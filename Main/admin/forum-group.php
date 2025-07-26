<?php
// written by denied_id

// admin/forum-group.php - Forum group detail and edit page

include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Admin\AdminHelper;

// Get forum group ID from URL
$group_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$group_id) {
    header("Location: /admin/forums");
    exit;
}

// Check if user is authenticated and has admin privileges
AdminHelper::requireAdmin();
$current_user = Auth::GetAuthenticatedUser();

// Handle form submission for forum group updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $sort_order = intval($_POST['sort_order'] ?? 0);
    
    try {
        $update_stmt = $conn->prepare("
            UPDATE forum_groups SET 
                name = :name,
                sort_order = :sort_order
            WHERE id = :group_id
        ");
        
        $update_stmt->execute([
            'name' => $name,
            'sort_order' => $sort_order,
            'group_id' => $group_id
        ]);
        
        $success_message = "Forum group updated successfully!";
    } catch (Exception $e) {
        $error_message = "Error updating forum group: " . $e->getMessage();
    }
}

// Get forum group data
$group_stmt = $conn->prepare("
    SELECT id, name, sort_order
    FROM forum_groups 
    WHERE id = :group_id
");
$group_stmt->execute(['group_id' => $group_id]);
$group = $group_stmt->fetch(PDO::FETCH_ASSOC);

if (!$group) {
    header("Location: /admin/forums");
    exit;
}

// Get forums in this group
$forums_stmt = $conn->prepare("
    SELECT id, name, description, threads_count, posts_count, sort_order
    FROM forums 
    WHERE group_id = :group_id
    ORDER BY sort_order ASC, name ASC
");
$forums_stmt->execute(['group_id' => $group_id]);
$forums = $forums_stmt->fetchAll(PDO::FETCH_ASSOC);

// Page setup
$page_title = "Admin Panel - Edit Forum Group: " . htmlspecialchars($group['name']);

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
                                                            <a class="linkMenuSink notranslate" href="/admin/forums">Forums Management</a>
                                                        </nobr>
                                                        <nobr>
                                                            <span class="normalTextSmallBold"> » </span>
                                                            <span class="normalTextSmallBold">Edit Forum Group</span>
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
                                                <h2 style="margin-bottom:20px">Edit Forum Group: <?= htmlspecialchars($group['name']) ?></h2>
                                            </td>
                                        </tr>
                                        
                                        <?php if (isset($success_message)): ?>
                                        <tr>
                                            <td colspan="2">
                                                <div style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                                                    <?= htmlspecialchars($success_message) ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        
                                        <?php if (isset($error_message)): ?>
                                        <tr>
                                            <td colspan="2">
                                                <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                                                    <?= htmlspecialchars($error_message) ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        
                                        <tr>
                                            <td colspan="2">
                                                <form method="POST" action="">
                                                    <table class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%; margin-bottom: 20px;">
                                                        <tbody>
                                                            <!-- Forum Group Information Section -->
                                                            <tr>
                                                                <td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px; padding: 5px;">
                                                                    <span class="normalTextSmallBold">Forum Group Information</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px; width: 200px;">
                                                                    <span class="normalTextSmallBold">Group ID:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= $group['id'] ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Group Name:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="text" name="name" value="<?= htmlspecialchars($group['name']) ?>" style="width: 400px; padding: 5px;" required>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Sort Order:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="number" name="sort_order" value="<?= $group['sort_order'] ?>" style="width: 100px; padding: 5px;" min="0">
                                                                    <span class="normalTextSmall" style="margin-left: 10px;">(Lower numbers appear first)</span>
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Action Buttons -->
                                                            <tr>
                                                                <td colspan="2" style="padding: 15px; text-align: center;">
                                                                    <input type="submit" value="Update Forum Group" class="btn-control btn-control-medium forum-btn-control-medium" style="margin-right: 10px;">
                                                                    <a href="/admin/forums" class="btn-control btn-control-medium forum-btn-control-medium">Back to Forums Management</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                        <!-- Forums in this Group -->
                                        <tr>
                                            <td align="left" colspan="2">
                                                <h3 style="margin-bottom:15px">Forums in this Group</h3>
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
                                                        <?php if (empty($forums)): ?>
                                                            <tr class="forum-content-background">
                                                                <td colspan="7" style="padding: 20px; text-align: center;">
                                                                    <span class="normalTextSmall">No forums in this group yet.</span>
                                                                </td>
                                                            </tr>
                                                        <?php else: ?>
                                                            <?php foreach ($forums as $index => $forum) : ?>
                                                                <tr class="<?= $index % 2 == 0 ? 'forum-content-background' : 'forum-content-background-alternate' ?>">
                                                                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                        <span class="normalTextSmall"><?= $forum['id'] ?></span>
                                                                    </td>
                                                                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                        <a href="/admin/forum?id=<?= $forum['id'] ?>" class="linkSmallBold"><?= htmlspecialchars($forum['name']) ?></a>
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
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
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
