<?php
// rewritten by SkylerClock to use the new feed system, originally written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\UserFeed;
use Roblox\Authentication as Auth;
$userId = Auth::GetUserID();
$startIndex = 0;
$maxRows = 20;
$feeds = UserFeed::getByUserIdPaged($userId, $startIndex, $maxRows);
if (empty($feeds)) {
    echo '<div class="no-feeds">No feeds available.</div>';
    exit;
}
foreach ($feeds as $userFeed) {
    $feedDAL = \Roblox\DataAccess\FeedDAL::get($userFeed->getFeedId());
    if (!$feedDAL) continue;
    $user = Auth::GetUserInfo($feedDAL->author_id);
    if (!$user) continue;
    $username = htmlspecialchars($user['username']);
    $content = htmlspecialchars($feedDAL->content);
    $timestamp = date('m/d/Y', $feedDAL->posted_at) . ' at ' . date('h:i A', $feedDAL->posted_at);
    $html = <<<HTML
<div class="divider-top feed-container">
    <div class="feed-image-container notranslate">
        <a href="/user.aspx?id={$user['id']}">
            <span class="feed-user-avatar">
                <img alt="{$username}" class="feed-user-avatar-image" src="/Images/Placeholder1024x1024.png" width=50 height=50>
            </span>
        </a>
    </div>
    <div class="feed-text-container text">
        <span class="notranslate">
            <a href="/User.aspx?ID={$user['id']}">{$username}</a><br>
            <div class="Feedtext">"{$content}"</div>
        </span>
        <span style="display: block; padding-top: 5px; color: #AAA; font-size: 11px;">{$timestamp}</span>
    </div>
    <div class="feed-report-abuse">
        <a href="/AbuseReport/Feed.aspx?ID={$feedDAL->post_id}&RedirectUrl=/home">
            <img src="//images.rbxcdn.com/1ea8de3b0f71a67b032b67ddc1770c78.png" alt="Report abuse">
        </a>
    </div>
    <div class="clear"></div>
</div>
HTML;
echo $html;
}
