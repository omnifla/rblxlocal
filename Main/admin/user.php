<?php 
// written by denied_id

// admin/user.php - User detail and edit page

include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

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

// Get user ID from URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$user_id) {
    header("Location: /admin");
    exit;
}

// Handle form submission for user updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $robux = intval($_POST['robux'] ?? 0);
    $tickets = intval($_POST['tickets'] ?? 0);
    $account_status_id = intval($_POST['account_status_id'] ?? 1);
    $membership_type = $_POST['membership_type'] ?? '';
    $description = $_POST['description'] ?? '';
    
    // Update password only if provided
    $password_update = '';
    if (!empty($_POST['password'])) {
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password_update = ', password = :password';
    }
    
    try {
        $update_sql = "
            UPDATE users SET 
                username = :username,
                email = :email,
                birthdate = :birthdate,
                gender = :gender,
                robux = :robux,
                tickets = :tickets,
                account_status_id = :account_status_id,
                membership_type = :membership_type,
                description = :description,
                updated = CURRENT_TIMESTAMP
                $password_update
            WHERE id = :user_id
        ";
        
        $update_stmt = $conn->prepare($update_sql);
        $params = [
            'username' => $username,
            'email' => $email,
            'birthdate' => $birthdate,
            'gender' => $gender,
            'robux' => $robux,
            'tickets' => $tickets,
            'account_status_id' => $account_status_id,
            'membership_type' => $membership_type,
            'description' => $description,
            'user_id' => $user_id
        ];
        
        if (!empty($_POST['password'])) {
            $params['password'] = $password_hash;
        }
        
        $update_stmt->execute($params);
        $success_message = "User updated successfully!";
    } catch (Exception $e) {
        $error_message = "Error updating user: " . $e->getMessage();
    }
}

// Get user data
$user_stmt = $conn->prepare("
    SELECT id, username, created_at, post_count, password, email, birthdate, gender, 
           created, updated, lastactive, account_status_id, moderation_status, 
           membership_type, use_super_safe_privacy_mode, robux, tickets, knockouts, 
           wipeouts, bodycolor, description, ips
    FROM users 
    WHERE id = :user_id
");
$user_stmt->execute(['user_id' => $user_id]);
$user = $user_stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: /admin");
    exit;
}

// Page setup
$page_title = "Admin Panel - Edit User: " . htmlspecialchars($user['username']);

// Include the header
SiteHeader::render(["pageTitle" => $page_title]);
?>

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
                                                            <span class="normalTextSmallBold">Edit User</span>
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
                                                <h2 style="margin-bottom:20px">Edit User: <?= htmlspecialchars($user['username']) ?></h2>
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
                                                    <table class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
                                                        <tbody>
                                                            <!-- Basic Information Section -->
                                                            <tr>
                                                                <td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px; padding: 5px;">
                                                                    <span class="normalTextSmallBold">Basic Information</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px; width: 200px;">
                                                                    <span class="normalTextSmallBold">User ID:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= $user['id'] ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Username:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" style="width: 300px; padding: 5px;" required>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Email:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" style="width: 300px; padding: 5px;">
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Password:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="password" name="password" placeholder="Leave blank to keep current password" style="width: 300px; padding: 5px;">
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Birthdate:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="date" name="birthdate" value="<?= htmlspecialchars($user['birthdate'] ?? '') ?>" style="width: 200px; padding: 5px;">
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Gender:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <select name="gender" style="width: 150px; padding: 5px;">
                                                                        <option value="">Not specified</option>
                                                                        <option value="Male" <?= ($user['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                                                                        <option value="Female" <?= ($user['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Account Status Section -->
                                                            <tr>
                                                                <td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px; padding: 5px;">
                                                                    <span class="normalTextSmallBold">Account Status</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Account Status:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <select name="account_status_id" style="width: 200px; padding: 5px;">
                                                                        <option value="1" <?= ($user['account_status_id'] ?? 1) == 1 ? 'selected' : '' ?>>Active</option>
                                                                        <option value="2" <?= ($user['account_status_id'] ?? 1) == 2 ? 'selected' : '' ?>>Banned</option>
                                                                        <option value="3" <?= ($user['account_status_id'] ?? 1) == 3 ? 'selected' : '' ?>>Suspended</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Membership Type:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <select name="membership_type" style="width: 200px; padding: 5px;">
                                                                        <option value="None" <?= ($user['membership_type'] ?? 'None') === 'None' ? 'selected' : '' ?>>None</option>
                                                                        <option value="Builders Club" <?= ($user['membership_type'] ?? '') === 'Builders Club' ? 'selected' : '' ?>>Builders Club</option>
                                                                        <option value="Turbo Builders Club" <?= ($user['membership_type'] ?? '') === 'Turbo Builders Club' ? 'selected' : '' ?>>Turbo Builders Club</option>
                                                                        <option value="Outrageous Builders Club" <?= ($user['membership_type'] ?? '') === 'Outrageous Builders Club' ? 'selected' : '' ?>>Outrageous Builders Club</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Currency Section -->
                                                            <tr>
                                                                <td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px; padding: 5px;">
                                                                    <span class="normalTextSmallBold">Currency & Stats</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Robux:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="number" name="robux" value="<?= $user['robux'] ?? 0 ?>" style="width: 150px; padding: 5px;" min="0">
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Tickets:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <input type="number" name="tickets" value="<?= $user['tickets'] ?? 0 ?>" style="width: 150px; padding: 5px;" min="0">
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Post Count:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= number_format($user['post_count'] ?? 0) ?> (read-only)</span>
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Profile Section -->
                                                            <tr>
                                                                <td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px; padding: 5px;">
                                                                    <span class="normalTextSmallBold">Profile</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px; vertical-align: top;">
                                                                    <span class="normalTextSmallBold">Description:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <textarea name="description" rows="4" style="width: 400px; padding: 5px;"><?= htmlspecialchars($user['description'] ?? '') ?></textarea>
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Timestamps Section -->
                                                            <tr>
                                                                <td class="forumHeaderBackgroundAlternate" colspan="2" style="height:20px; padding: 5px;">
                                                                    <span class="normalTextSmallBold">Timestamps</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Created:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= $user['created_at'] ? date('M j, Y g:i A', strtotime($user['created_at'])) : 'N/A' ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background-alternate">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Last Updated:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= $user['updated'] ? date('M j, Y g:i A', strtotime($user['updated'])) : 'Never' ?></span>
                                                                </td>
                                                            </tr>
                                                            <tr class="forum-content-background">
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmallBold">Last Active:</span>
                                                                </td>
                                                                <td style="padding: 10px;">
                                                                    <span class="normalTextSmall"><?= $user['lastactive'] ? date('M j, Y g:i A', strtotime($user['lastactive'])) : 'Never' ?></span>
                                                                </td>
                                                            </tr>
                                                            
                                                            <!-- Action Buttons -->
                                                            <tr>
                                                                <td colspan="2" style="padding: 15px; text-align: center;">
                                                                    <input type="submit" value="Update User" class="btn-control btn-control-medium forum-btn-control-medium" style="margin-right: 10px;">
                                                                    <a href="/admin" class="btn-control btn-control-medium forum-btn-control-medium">Back to User List</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
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
