<?php
// written by denied_id
// bro, this is so obviously written by gpt
// admin.php - Main admin panel

include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Admin\AdminHelper;

// Check if user is authenticated and has admin privileges
AdminHelper::requireAdmin();
$current_user = Auth::GetAuthenticatedUser();

// Get all users from database with the complete user table structure
$users_stmt = $conn->prepare("
    SELECT id, username, created_at, post_count, email, birthdate, gender, 
           account_status_id, moderation_status, membership_type, robux, tickets
    FROM users 
    ORDER BY id ASC
");
$users_stmt->execute();
$users = $users_stmt->fetchAll(PDO::FETCH_ASSOC);

// Page setup
$page_title = "Admin Panel - User Management";

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
                                                            <span class="normalTextSmallBold">Admin Panel</span>
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
                                                <h3 style="margin-bottom:15px">User Management</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <table class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
                                                    <tbody>
                                                        <!-- Table Header -->
                                                        <tr>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">ID</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Username</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Email</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Join Date</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Posts</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Robux</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Status</span>
                                                            </td>
                                                            <td class="forumHeaderBackgroundAlternate" style="height:20px; padding: 5px;">
                                                                <span class="normalTextSmallBold">Actions</span>
                                                            </td>
                                                        </tr>

                                                        <!-- User Rows -->
                                                        <?php foreach ($users as $index => $user) : ?>
                                                            <tr class="<?= $index % 2 == 0 ? 'forum-content-background' : 'forum-content-background-alternate' ?>">
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= $user['id'] ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <a href="/admin/user?id=<?= $user['id'] ?>" class="linkSmallBold"><?= htmlspecialchars($user['username']) ?></a>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= htmlspecialchars($user['email'] ?? 'N/A') ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= $user['created_at'] ? date('M j, Y', strtotime($user['created_at'])) : 'N/A' ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= number_format($user['post_count'] ?? 0) ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall"><?= number_format($user['robux'] ?? 0) ?></span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <span class="normalTextSmall">
                                                                        <?php
                                                                        $status = $user['account_status_id'] ?? 1;
                                                                        echo $status == 1 ? 'Active' : ($status == 2 ? 'Banned' : 'Unknown');
                                                                        ?>
                                                                    </span>
                                                                </td>
                                                                <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                                                                    <a href="/admin/user?id=<?= $user['id'] ?>" class="linkSmall">Edit</a>
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
                                                <span class="normalTextSmall">Total Users: <?= count($users) ?></span>
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