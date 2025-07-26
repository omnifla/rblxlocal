<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

// Check if user is authenticated
$current_user = Auth::GetAuthenticatedUser();
if (!$current_user || $current_user['account_status_id'] != 1) {
    header("Location: /newlogin");
    exit;
}

$forum_id = isset($_GET['ForumID']) ? intval($_GET['ForumID']) : 0;

if ($forum_id === 0) {
    header("Location: /Forum/Default.aspx");
    exit();
}

// Fetch forum details
$stmt = $conn->prepare('SELECT f.id, f.name, f.description, f.group_id, fg.name as group_name FROM forums f JOIN forum_groups fg ON f.group_id = fg.id WHERE f.id = :id');
$stmt->execute(['id' => $forum_id]);
$forum = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$forum) {
    die('Forum not found.');
}

$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = trim($_POST['subject'] ?? '');
    $content = trim($_POST['content'] ?? '');
    
    if (empty($subject)) {
        $error_message = 'Thread subject is required.';
    } elseif (strlen($subject) > 255) {
        $error_message = 'Thread subject is too long (maximum 255 characters).';
    } elseif (empty($content)) {
        $error_message = 'Thread content is required.';
    } else {
        try {
            $conn->beginTransaction();
            
            // Create the thread
            $thread_stmt = $conn->prepare("
                INSERT INTO threads (forum_id, user_id, subject, created_at, last_post_at, last_post_user_id) 
                VALUES (:forum_id, :user_id, :subject, NOW(), NOW(), :user_id)
            ");
            
            $thread_stmt->execute([
                ':forum_id' => $forum_id,
                ':user_id' => $current_user['id'],
                ':subject' => $subject
            ]);
            
            $thread_id = $conn->lastInsertId();
            
            // Create the first post
            $post_stmt = $conn->prepare("
                INSERT INTO posts (thread_id, user_id, content, created_at) 
                VALUES (:thread_id, :user_id, :content, NOW())
            ");
            
            $post_stmt->execute([
                ':thread_id' => $thread_id,
                ':user_id' => $current_user['id'],
                ':content' => $content
            ]);
            
            // Update thread reply count
            $update_thread = $conn->prepare("UPDATE threads SET replies_count = 1 WHERE id = :thread_id");
            $update_thread->execute([':thread_id' => $thread_id]);
            
            // Update user post count
            $update_user = $conn->prepare("UPDATE users SET post_count = post_count + 1 WHERE id = :user_id");
            $update_user->execute([':user_id' => $current_user['id']]);
            
            $conn->commit();
            
            // Redirect to the new thread
            header("Location: /Forum/ShowPost.aspx.php?PostID={$thread_id}");
            exit;
            
        } catch (Exception $e) {
            $conn->rollBack();
            $error_message = 'Error creating thread: ' . $e->getMessage();
        }
    }
}

?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">

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
                                    <nobr>
                                        <span class="normalTextSmallBold"> » </span>
                                        <span class="normalTextSmallBold">New Thread</span>
                                    </nobr>
                                </div>
                            </span></td>
                        <td align="right"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1">
                                <div id="forum-nav" style="text-align: right; white-space: nowrap;">
                                    <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx" style="display: inline;">Home</a>
                                    <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx" style="display: inline;">Search</a>
                                </div>
                            </span></td>
                    </tr>
                    <tr style="text-align: center;">
                    <td id="ctl00_cphRoblox_CenterColumn" class="CenterColumn" style="text-align: center; vertical-align: top; width: 100%;">
                        <br>
                        
                        <?php if ($error_message): ?>
                        <div style="color: red; margin-bottom: 10px; padding: 10px; border: 1px solid red; background-color: #ffe6e6;">
                            <?= htmlspecialchars($error_message) ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($success_message): ?>
                        <div style="color: green; margin-bottom: 10px; padding: 10px; border: 1px solid green; background-color: #e6ffe6;">
                            <?= htmlspecialchars($success_message) ?>
                        </div>
                        <?php endif; ?>
                        
                        <div style="display: flex; justify-content: center; width: 100%;">
                        <form method="POST" action="">
                            <table class="table" width="600" cellpadding="2" cellspacing="1" border="0" style="margin: 0 auto;">
                                <tr class="table-header forum-table-header">
                                    <th class="first" colspan="2">Create New Thread in <?= htmlspecialchars($forum['name']) ?></th>
                                </tr>
                                <tr class="table-row1">
                                    <td class="forum-table-cell" style="width: 15%; font-weight: bold; vertical-align: top; padding: 10px;">
                                        Subject:
                                    </td>
                                    <td class="forum-table-cell" style="padding: 10px;">
                                        <input type="text" name="subject" id="subject" value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>" 
                                               style="width: 100%; max-width: 500px; padding: 5px;" maxlength="255" required>
                                        <br><small>Maximum 255 characters</small>
                                    </td>
                                </tr>
                                <tr class="table-row2">
                                    <td class="forum-table-cell" style="width: 15%; font-weight: bold; vertical-align: top; padding: 10px;">
                                        Message:
                                    </td>
                                    <td class="forum-table-cell" style="padding: 10px;">
                                        <textarea name="content" id="content" rows="10" 
                                                  style="width: 100%; max-width: 600px; padding: 5px;" required><?= htmlspecialchars($_POST['content'] ?? '') ?></textarea>
                                        <br><small>Enter your thread content here</small>
                                    </td>
                                </tr>
                                <tr class="table-row1">
                                    <td class="forum-table-cell" colspan="2" style="padding: 10px; text-align: center;">
                                        <input type="submit" value="Post" class="btn-control btn-control-medium forum-btn-control-medium" style="margin-right: 10px;">
                                        <input type="button" id="previewBtn" value="Preview" class="btn-control btn-control-medium forum-btn-control-medium" style="margin-right: 10px;" onclick="openPreview()">
                                        <a href="/Forum/ShowForum.aspx.php?ForumID=<?= $forum_id ?>" class="btn-control btn-control-medium forum-btn-control-medium">Cancel</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        </div>
                        
                        <!-- Preview Area -->
                        <div id="previewArea" style="display: none; margin-top: 20px;">
                            <table class="table" width="600" cellpadding="2" cellspacing="1" border="0" style="margin: 0 auto;">
                                <tr class="table-header forum-table-header">
                                    <th class="first" colspan="2">Preview</th>
                                </tr>
                                <tr class="table-row1">
                                    <td class="forum-table-cell" style="width: 15%; font-weight: bold; vertical-align: top; padding: 10px;">
                                        Subject:
                                    </td>
                                    <td class="forum-table-cell" style="padding: 10px;">
                                        <div id="previewSubject" style="font-weight: bold;"></div>
                                    </td>
                                </tr>
                                <tr class="table-row2">
                                    <td class="forum-table-cell" style="width: 15%; font-weight: bold; vertical-align: top; padding: 10px;">
                                        Message:
                                    </td>
                                    <td class="forum-table-cell" style="padding: 10px;">
                                        <div id="previewContent" style="white-space: pre-wrap;"></div>
                                    </td>
                                </tr>

                            </table>
                        </div>
                        
                        <br>
                        
                    </td>
                    </tr>
                </table>
            </div>
            
            <?= SiteFooter::render() ?>
        </div>
    </div>
<script>
var forumName = "<?= addslashes($forum['name']) ?>";
var groupName = "<?= addslashes($forum['group_name']) ?>";
var previewVisible = false;

function togglePreview() {
    var previewBtn = document.getElementById('previewBtn');
    var previewArea = document.getElementById('previewArea');
    
    if (previewVisible) {
        // Hide preview
        previewArea.style.display = 'none';
        previewBtn.value = 'Preview';
        previewVisible = false;
        
        // Remove live update listeners
        document.getElementById('subject').removeEventListener('input', updatePreview);
        document.getElementById('content').removeEventListener('input', updatePreview);
    } else {
        // Show preview
        var subject = document.getElementById('subject').value;
        var content = document.getElementById('content').value;
        
        if (!subject.trim()) {
            alert('Please enter a subject before previewing.');
            return;
        }
        
        if (!content.trim()) {
            alert('Please enter message content before previewing.');
            return;
        }
        
        updatePreview();
        previewArea.style.display = 'block';
        previewBtn.value = 'Hide Preview';
        previewVisible = true;
        
        // Add live update listeners
        document.getElementById('subject').addEventListener('input', updatePreview);
        document.getElementById('content').addEventListener('input', updatePreview);
        
        // Scroll to preview
        previewArea.scrollIntoView({ behavior: 'smooth' });
    }
}

function updatePreview() {
    var subject = document.getElementById('subject').value;
    var content = document.getElementById('content').value;
    
    // Update preview content with HTML support
    document.getElementById('previewSubject').innerHTML = subject || '<em>No subject</em>';
    document.getElementById('previewContent').innerHTML = content || '<em>No content</em>';
}

function openPreview() {
    var subject = document.getElementById('subject').value;
    var content = document.getElementById('content').value;

    if (!subject.trim()) {
        alert('Please enter a subject before previewing.');
        return;
    }
    if (!content.trim()) {
        alert('Please enter message content before previewing.');
        return;
    }

    var url = '/Forum/PreviewPost.aspx.php?subject=' + encodeURIComponent(subject) + '&content=' + encodeURIComponent(content) + '&forum=' + encodeURIComponent(forumName) + '&group=' + encodeURIComponent(groupName);
    window.open(url, '_blank');
}

// Function to sanitize HTML (basic security)
function sanitizeHTML(html) {
    var temp = document.createElement('div');
    temp.innerHTML = html;
    
    // Remove script tags and other potentially dangerous elements
    var scripts = temp.querySelectorAll('script');
    for (var i = 0; i < scripts.length; i++) {
        scripts[i].remove();
    }
    
    return temp.innerHTML;
}
</script>

</body>

</html>