<?php
// written by denied_id

// admin/forum.php - Forum detail and edit page

include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

// Get forum ID from URL
$forum_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$forum_id) {
    header("Location: /admin/forums");
    exit;
}

// Check if user is authenticated and has admin privileges
$current_user = Auth::GetAuthenticatedUser();
if (!$current_user || $current_user['account_status_id'] != 1) {
    header("Location: /newlogin");
    exit;
}

// Check if user has admin privileges - using user ID 1 as admin or specific usernames
$admin_usernames = ['admin', 'administrator', 'roblox']; // Add your admin usernames here
if ($current_user['id'] != 1 && !in_array(strtolower($current_user['username']), $admin_usernames)) {
    header("Location: /");
    exit;
}

// Handle form submission for forum updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $group_id = intval($_POST['group_id'] ?? 0);
    $sort_order = intval($_POST['sort_order'] ?? 0);
    
    try {
        $update_stmt = $conn->prepare("
            UPDATE forums SET 
                name = :name,
                description = :description,
                group_id = :group_id,
                sort_order = :sort_order
            WHERE id = :forum_id
        ");
        
        $update_stmt->execute([
            'name' => $name,
            'description' => $description,
            'group_id' => $group_id,
            'sort_order' => $sort_order,
            'forum_id' => $forum_id
        ]);
        
        $success_message = "Forum updated successfully!";
    } catch (Exception $e) {
        $error_message = "Error updating forum: " . $e->getMessage();
    }
}

// Get forum data
$forum_stmt = $conn->prepare("
    SELECT f.id, f.name, f.description, f.threads_count, f.posts_count, f.sort_order,
           f.group_id, fg.name as group_name
    FROM forums f
    JOIN forum_groups fg ON f.group_id = fg.id
    WHERE f.id = :forum_id
");
$forum_stmt->execute(['forum_id' => $forum_id]);
$forum = $forum_stmt->fetch(PDO::FETCH_ASSOC);

if (!$forum) {
    header("Location: /admin/forums");
    exit;
}

// Get all forum groups for the dropdown
$groups_stmt = $conn->prepare("
    SELECT id, name
    FROM forum_groups
    ORDER BY sort_order ASC, name ASC
");
$groups_stmt->execute();
$forum_groups = $groups_stmt->fetchAll(PDO::FETCH_ASSOC);

// Get recent threads in this forum
$threads_stmt = $conn->prepare("
    SELECT t.id, t.subject, t.created_at, t.views_count, t.replies_count,
           u.username as author_name
    FROM threads t
    JOIN users u ON t.user_id = u.id
    WHERE t.forum_id = :forum_id
    ORDER BY t.created_at DESC
    LIMIT 10
");
$threads_stmt->execute(['forum_id' => $forum_id]);
$recent_threads = $threads_stmt->fetchAll(PDO::FETCH_ASSOC);

// Page setup
$page_title = "Admin Panel - Edit Forum: " . htmlspecialchars($forum['name']);

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
                                                            <span class="normalTextSmallBold">Edit Forum</span>
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
                                                <h2 style="margin-bottom:20px">Edit Forum: <?= htmlspecialchars($forum['name']) ?></h2>
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
                                                            <!-- Forum Information Section -->
                                                            <tr>
                                                                <td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px; padding: 5px;">
                                                                    <span class="normalTextSmallBold">Forum Information</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px; width: 200px;">
                                                                    <span class="normalTextSmallBold">Forum ID:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= $forum['id'] ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Forum Name:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="text" name="name" value="<?= htmlspecialchars($forum['name']) ?>" style="width: 400px; padding: 5px;" required>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px; vertical-align: top;">
                                                                    <span class="normalTextSmallBold">Description:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <textarea name="description" rows="4" style="width: 500px; padding: 5px;"><?= htmlspecialchars($forum['description'] ?? '') ?></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Forum Group:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <select name="group_id" style="width: 300px; padding: 5px;" required>
                                                                        <?php foreach ($forum_groups as $group): ?>
                                                                            <option value="<?= $group['id'] ?>" <?= $group['id'] == $forum['group_id'] ? 'selected' : '' ?>>
                                                                                <?= htmlspecialchars($group['name']) ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Sort Order:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="number" name="sort_order" value="<?= $forum['sort_order'] ?>" style="width: 100px; padding: 5px;" min="0">
                                                                    <span class="normalTextSmall" style="margin-left: 10px;">(Lower numbers appear first)</span>
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Statistics Section -->
                                                            <tr>
                                                                <td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px; padding: 5px;">
                                                                    <span class="normalTextSmallBold">Statistics</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Total Threads:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= number_format($forum['threads_count']) ?> (read-only)</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Total Posts:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= number_format($forum['posts_count']) ?> (read-only)</span>
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Action Buttons -->
                                                            <tr>
                                                                <td colspan="2" style="padding: 15px; text-align: center;">
                                                                    <input type="submit" value="Update Forum" class="btn-control btn-control-medium forum-btn-control-medium" style="margin-right: 10px;">
                                                                    <a href="/admin/forums" class="btn-control btn-control-medium forum-btn-control-medium">Back to Forums Management</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                        <!-- Recent Threads -->
                                        <tr>
                                            <td align="left" colspan="2">
                                                <h3 style="margin-bottom:15px">Recent Threads</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
                                                    <tbody>
                                                        <!-- Threads Header -->
                                                        <tr>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">ID</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Thread Subject</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Author</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Created</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Replies</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Views</span>
                                                            </td>
                                                        </tr>

                                                        <!-- Threads Rows -->
                                                        <?php if (empty($recent_threads)): ?>
                                                            <tr class="forum-content-background">
                                                                <td colspan="6" style="padding: 20px; text-align: center;">
                                                                    <span class="normalTextSmall">No threads in this forum yet.</span>
                                                                </td>
                                                            </tr>
                                                        <?php else: ?>
                                                            <?php foreach ($recent_threads as $index => $thread) : ?>
                                                                <tr class="<?= $index % 2 == 0 ? 'forum-content-background' : 'forum-content-background-alternate' ?>">
                                                                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                        <span class="normalTextSmall"><?= $thread['id'] ?></span>
                                                                    </td>
                                                                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                        <a href="/Forum/ShowPost.aspx.php?id=<?= $thread['id'] ?>" class="linkSmallBold"><?= htmlspecialchars($thread['subject']) ?></a>
                                                                    </td>
                                                                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                        <span class="normalTextSmall"><?= htmlspecialchars($thread['author_name']) ?></span>
                                                                    </td>
                                                                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                        <span class="normalTextSmall"><?= date('M j, Y', strtotime($thread['created_at'])) ?></span>
                                                                    </td>
                                                                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                        <span class="normalTextSmall"><?= number_format($thread['replies_count']) ?></span>
                                                                    </td>
                                                                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                        <span class="normalTextSmall"><?= number_format($thread['views_count']) ?></span>
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
