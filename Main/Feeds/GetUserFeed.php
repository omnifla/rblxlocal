<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
$feed_limit = 20;
$feeds = $conn->query("SELECT * FROM feeds ORDER BY post_id DESC LIMIT $feed_limit")->fetchAll(PDO::FETCH_ASSOC);
// fetch the feeds
// if there isnt any feeds, output a message
if (empty($feeds)) {
    echo '<div class="no-feeds">No feeds available.</div>';
    exit;
}
foreach ($feeds as $feed) {
    $feed_content = htmlspecialchars($feed['content']);
    $feed_date = date('m/d/Y', $feed['posted_at']) . " at " . date('h:i A', $feed['posted_at']);
    $user = Auth::GetUserInfo($feed['author_id']);
    if (!$user) {
        continue; // skip if user not found
    }
    $username = htmlspecialchars($user['username']);
$html = <<<HTML
    	        <div class="divider-top feed-container"><div class="feed-image-container notranslate">
                <a href="http://{$site_properties['hostname']}/user.aspx?id={$user['id']}"><span class="feed-user-avatar"><img alt="{$username}" class="feed-user-avatar-image" src="/Images/Placeholder1024x1024.png" width=50 height=50></span>
                    </a></div><div class="feed-text-container text"><span class="notranslate"><a href="http://{$site_properties['hostname']}/User.aspx?ID={$user['id']}">{$username}</a><br><div class="Feedtext">"{$feed_content}"</div></span><span style="display: block; padding-top: 5px; color: #AAA; font-size: 11px;">{$feed_date}</span> </div><div class="feed-report-abuse"><a href="http://{$site_properties['hostname']}/AbuseReport/Feed.aspx?ID=64045715&RedirectUrl=/home"><img src="//images.rbxcdn.com/1ea8de3b0f71a67b032b67ddc1770c78.png" alt="Report abuse" id="reportAbuseButton"> </a></div><div class="clear"></div></div>
    HTML;
    echo $html;
}
?>
