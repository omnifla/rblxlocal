<?php
// written by SkylerClock to use the new feed system, originally written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication;
use Roblox\UserFeed;
use Roblox\DataAccess\FeedDAL;
$userId = $info['id'] ?? 0;
$limit = 20;
if ($userId === 0) {
    echo '<div class="no-feeds">You must be logged in to see your feed.</div>';
    exit;
}
$feeds = UserFeed::getByUserIdPaged($userId, 0, $limit);
if (empty($feeds)) {
    echo '<div class="no-feeds">No feeds available.</div>';
    exit;
}
foreach ($feeds as $userFeed) {
    $feedDAL = FeedDAL::get($userFeed->getFeedId());
    if (!$feedDAL) {
        continue;
    }
    $author = Authentication::GetUserInfo($feedDAL->author_id);
    if (!$author) {
        continue;
    }
    $feed_content = htmlspecialchars($feedDAL->content);
    $feed_date = date('m/d/Y', $feedDAL->posted_at) . " at " . date('h:i A', $feedDAL->posted_at);
    $username = htmlspecialchars($author['username']);
    $html = <<<HTML
        <div class="divider-top feed-container">
            <div class="feed-image-container notranslate">
                <a href="/user.aspx?id={$author['id']}">
                    <span class="feed-user-avatar">
                        <img alt="{$username}" class="feed-user-avatar-image" src="/Images/Placeholder1024x1024.png" width=50 height=50>
                    </span>
                </a>
            </div>
            <div class="feed-text-container text">
                <span class="notranslate">
                    <a href="/User.aspx?ID={$author['id']}">{$username}</a><br>
                    <div class="Feedtext">"{$feed_content}"</div>
                </span>
                <span style="display: block; padding-top: 5px; color: #AAA; font-size: 11px;">{$feed_date}</span>
            </div>
            <div class="feed-report-abuse">
                <a href="/AbuseReport/Feed.aspx?ID={$feedDAL->post_id}&RedirectUrl=/home">
                    <img src="//images.rbxcdn.com/1ea8de3b0f71a67b032b67ddc1770c78.png" alt="Report abuse" id="reportAbuseButton">
                </a>
            </div>
            <div class="clear"></div>
        </div>
    HTML;
    echo $html;
}
