<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

// Fetch data from query parameters
$subject = isset($_GET['subject']) ? trim($_GET['subject']) : '';
$content = isset($_GET['content']) ? trim($_GET['content']) : '';

// Forum context
$forum_name = $_GET['forum'] ?? 'Forum';
$group_name = $_GET['group'] ?? 'Group';

// Redirect back if required fields missing
if ($subject === '' || $content === '') {
    header('Location: /Forum/');
    exit;
}

/**
 * Basic sanitization for forum post HTML – same as ShowPost
 */
function sanitize_forum_html($html)
{
    return preg_replace('#<script\b[^>]*>(.*?)</script>#is', '', $html);
}

$page_title = 'Preview: ' . htmlspecialchars($subject);

SiteHeader::render(["pageTitle" => $page_title]);
?>

<head>
    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___d0a32d7530b30a6f5d85fd297f8b6898_m.css' />
    <link rel='stylesheet' href='/Forum/skins/default/style/default.css' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                                                        <nobr><a class="linkMenuSink notranslate" href="/Forum/Default.aspx.php">ROBLOX Forum</a></nobr>
                                                        <nobr><span class="normalTextSmallBold"> » </span><a class="linkMenuSink notranslate" href="#"><?= htmlspecialchars($group_name) ?></a></nobr>
                                                        <nobr><span class="normalTextSmallBold"> » </span><a class="linkMenuSink notranslate" href="#"><?= htmlspecialchars($forum_name) ?></a></nobr>
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
                                        <tr>
                                            <td align="left" colspan="2">&nbsp;</td>
                                        </tr>
                        </tr>
                    </tbody>
                </table>
                <h2 style="margin-bottom:20px"><?= htmlspecialchars($subject) ?></h2>
                <table class="tableBorder" cellspacing="1" cellpadding="0" border="0" style="width:100%;">
                    <tbody>
                        <tr class="forum-post">
                            <td class="forum-content-background" valign="top" style="width:150px;white-space:nowrap;">
                                <!-- Placeholder user info since this is a preview -->
                                <table border="0">
                                    <tbody>
                                        <tr>
                                            <td><b><span class="normalTextSmallBold">You</span></b><br></td>
                                        </tr>
                                        <tr>
                                            <td><img src="/Images/Placeholder1024x1024.png" style="border-width:0px;width:100px;height:100px;" /></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="forum-content-background" valign="top">
                                <table cellspacing="0" cellpadding="3" border="0" style="width:100%;border-collapse:collapse;table-layout:fixed;overflow:hidden;word-wrap:break-word;">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><span class="normalTextSmaller">Just now</span></td>
                                        </tr>
                                        <tr>
                                            <td valign="top" colspan="2" style="height:125px;"><span class="normalTextSmall notranslate"><?= nl2br(sanitize_forum_html($content)) ?></span></td>
                                        </tr>
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
            <?= SiteFooter::render() ?>
        </div>
    </div>
</body>