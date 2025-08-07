<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\DataAccess\FeedificationDAL;
$dal = new FeedificationDAL();
$feed = $dal->getRecent(1);
header('Content-Type: text/html; charset=UTF-8');
if (count($feed) === 0) {
    echo '';
    exit;
}

$f = $feed[0];
?>
<h2>Updates from RBLX.local</h2>
<div class="feedification divider-top">
    <div class="feed-image-container notranslate">
        <img src="http://images.rbxcdn.com/4e56605c371ea6d5f629e2715012fc56.gif" alt="" width="48" height="48">
    </div>
    <div class="feed-text-container text">
        <h3><?= htmlspecialchars($f->title) ?></h3>
        <div><?= nl2br(htmlspecialchars($f->message)) ?></div>
    </div>
    <div class="clear"></div>
</div>
