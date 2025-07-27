<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

// Fetch forum groups
$groups = $conn->query('SELECT id, name FROM forum_groups ORDER BY sort_order ASC')->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___09c4a1b67a03bbb716c6f0c4a2a425b4_m.css' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
    <link rel='stylesheet' href='/Forum/skins/default/style/default.css' />

<body>
    <div id="BodyWrapper">
        <div id="RepositionBody">
            <?= SiteHeader::render() ?>
            <div class="forceSpace">&nbsp;</div>
            <div id="Body" style="width:970px;">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td align="left"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1" name="Whereami1">
                                    <div>
                                        <nobr>
                                            <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx.php">ROBLOX Forum</a>
                                        </nobr>
                                    </div>
                                </span></td>
                            <td align="right"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1">
                                    <div id="forum-nav" style="text-align: right">
                                        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx.php">Home</a>
                                        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
                                    </div>
                                </span></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table cellpadding="0" cellspacing="2" width="100%">
                    <tbody>
                        <tr>
                            <td align="left">
                                <span class="normalTextSmallBold">Current time: </span><span class="normalTextSmall">Jun 6, 1:47 PM</span>
                            </td>
                            <td align="right">
                                <span id="ctl00_cphRoblox_SearchRedirect">

                                    <span>
                                        <span class="normalTextSmallBold">Search Roblox Forums:</span>
                                        <input name="ctl00$cphRoblox$SearchRedirect$ctl00$SearchText" type="text" maxlength="50" id="ctl00_cphRoblox_SearchRedirect_ctl00_SearchText" class="notranslate" size="20">
                                        <input type="submit" name="ctl00$cphRoblox$SearchRedirect$ctl00$SearchButton" value="Go" id="ctl00_cphRoblox_SearchRedirect_ctl00_SearchButton" class="translate btn-control btn-control-medium forum-btn-control-medium">
                                    </span></span>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="height:7px;"></div>
                <table cellpadding="2" cellspacing="1" border="0" width="100%" class="table">
                    <?php foreach ($groups as $group): ?>
                        <tr class="table-header forum-table-header">
                            <th class="first" colspan="2">
                                <a class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?php echo htmlspecialchars($group['id']); ?>">
                                    <?php echo htmlspecialchars($group['name']); ?>
                                </a>
                            </th>
                            <th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th>
                            <th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th>
                            <th style="width:135px;white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
                        </tr>
                        <?php
                        // Fetch forums for this group
                        $stmt = $conn->prepare('SELECT id, name, description, threads_count, posts_count FROM forums WHERE group_id = :group_id ORDER BY sort_order ASC');
                        $stmt->execute(['group_id' => $group['id']]);
                        $forums = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($forums as $forum):
                        ?>
                            <tr class="forum-table-row">
                                <td colspan="2" style="width:80%;">
                                    <a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=<?php echo htmlspecialchars($forum['id']); ?>">
                                        <div class="forumTitle"><?php echo htmlspecialchars($forum['name']); ?></div>
                                        <div><?php echo htmlspecialchars($forum['description']); ?></div>
                                    </a>
                                </td>
                                <td class="forum-centered-cell" align="center"><span class="normalTextSmaller"><?php echo number_format($forum['threads_count']); ?></span></td>
                                <td class="forum-centered-cell" align="center"><span class="normalTextSmaller"><?php echo number_format($forum['posts_count']); ?></span></td>
                                <td align="center">
                                    <span class="normalTextSmaller">N/A</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </table>
            </div>
            <?= SiteFooter::render() ?>
        </div>
    </div>
</body>

</html>
