<?php
// written by SkylerClock to use the new feeds system, originally written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication;
use Roblox\UserFeed;
$limit = 20;
$feeds = UserFeed::getRecent($limit);
if (empty($feeds)) {
    echo '<div class="no-feeds">No feeds available.</div>';
    exit;
}
foreach ($feeds as $feed) {
    $feed_content = htmlspecialchars($feed->getFeedContent());
    $feed_timestamp = $feed->getFeedPostTime();
    $feed_date = date('m/d/Y', $feed_timestamp) . " at " . date('h:i A', $feed_timestamp);
    $author_id = $feed->getFeedAuthorId();
    if ($author_id === null) continue;
    $author = \Roblox\Authentication::GetUserInfo($author_id);
    $username = htmlspecialchars($author['username']);
    echo <<<HTML
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
            <a href="/AbuseReport/Feed.aspx?ID={$feed->getPostId()}&RedirectUrl=/home">
                <img src="//images.rbxcdn.com/1ea8de3b0f71a67b032b67ddc1770c78.png" alt="Report abuse" id="reportAbuseButton">
            </a>
        </div>
        <div class="clear"></div>
    </div>
    HTML;
}
