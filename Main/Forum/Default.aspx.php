<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteAlert;

// Fetch forum groups
$groups = $conn->query('SELECT id, name FROM forum_groups ORDER BY sort_order ASC')->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>

<head>
    <title><?= $site_properties['Title'] ?> Forum</title>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___23e1cfc4f7f34bdc2ff4f3c2d637a122_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___f6e33d41f2d5a62b5a238c0bbdc70438_m.css' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link rel='stylesheet' href='/Forum/skins/default/style/default.css' />

<body>
    <div id="roblox-linkify" data-enabled="true"
        data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer)\.roblox\.com|robloxlabs\.com)((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))"
        data-regex-flags="gm"></div>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
    <script
        type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
    <script type="text/javascript"
        src="//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js"></script>
    <script
        type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
    <script
        type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js"></script>
    <script
        type="text/javascript">window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
    <script type="text/javascript" src="http://js.rbxcdn.com/a6e157368e6c323300f3f0cbf2ec7b8a.js"></script>
    <script
        type="text/javascript">Roblox.config.externalResources = []; Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/1612c57544c7977e19cd15c824f7ecc3.js'; Roblox.config.paths['Pages.CatalogShared'] = 'http://js.rbxcdn.com/209f2b781ea84e8d0332648ddf547d57.js'; Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/e8cbac58ab4f0d8d4c707700c9f97630.js'; Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js'; Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/bbaeb48f3312bad4626e00c90746ffc0.js'; Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/7b436bae917789c0b84f40fdebd25d97.js'; Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/33d82b98045d49ec5a1f635d14cc7010.js'; Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/fbb86cf0752d23f389f983419d3085b4.js'; Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/8babd891cf420dfe3999b3824a0154cb.js'; Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/f2697119678d0851cfaa6c2270a727ed.js'; Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script>
    <script type="text/javascript">
        $(function () {
            Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true });
        });
    </script>
    <script type="text/javascript" src="http://js.rbxcdn.com/93b2b1e39d84a82e066b7950e66a0edc.js"></script>
    <script type="text/javascript">Roblox.XsrfToken.setToken('bPNlc2mJ7czH');</script>
    <script type="text/javascript">
        if (top.location != self.location) {
            top.location = self.location.href;
        }
    </script>
    <style type="text/css"></style>
    <form name="aspnetForm" method="post" action="/Forum/Default.aspx" id="aspnetForm" class="nav-container no-gutter-ads">
<div>
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="">
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="bAwBOHVlpU3dh0LuloznVeCnLOg+fxmpMz9Og9IEDEE0dj5rQcNZkCAOrpzeo6TiJaDwBYaEmFF/bRbMW6haJTv4V2e08bAD0E72QYUrfeEP+ByReDKWllp5Jui4c9h+gNUwSp0MB0IkOTLScjiZa4NP/XG04WBa2hcfXcMLun5jeufTWnIHm0zGJguSMcqLo1KlRiiARG0sSCoq4RUOjoDoV4TM6iziqDnOdF1X7ZXvQN7IzQoCYr6+DcnpC7Hbe/lsY63M7O1kSYJ8COFxJhXCyYk=">
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['aspnetForm'];
if (!theForm) {
    theForm = document.aspnetForm;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>



<script src="/ScriptResource.axd?d=opkyubSULYgcbczF582tbvqeU21reMdEaBtRJ9Au83NVNaf7jjJQoL5ZgYtaapihNTJJZl7cSGEND1aHEyYbGcxhD1N5ZlvB2l_qDC5oG_pUsgbkXYn5P1csBIGrFtv9pBX4oLRqcBJl0__vJ4qx4OND8El6crFbxDs9l9YD2Fw1JaP7P-64JWVGTG83iuI6CWpFerCvaW6OtTQ6CfSJlD0F9o6v6KMds8Ho0-kOeQM-lsXvwneHLHh9Fghu9YqpBb_FK95117bFdVVIeI4l4QdS_Q2Pt_mQ84IMi3LE1IEyFgjBTUBf7qx5jnZfmgYeTcsgm9Fcf6VjM_ocgh41Wz7ceCP21O6IoGcbYgdjHuLXGfH_CJaoIdiR1vZrEpRYrl5vhtpsenE5MoXEe8hiejZM6rzEpQY5SAqmbN_siSmU4pOm0" type="text/javascript"></script>
<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="D00095AD">
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="f/30OAnXZ1xzf1GDzK7fqPp0jfOKmenkoQs4Qvr/3CWYH0fJi3Dvvvu22zqFXw5StrvjIJRllEDbiM0zlQ3cmGu9mU5JH/8thi4C9A9nyvPINIrdjEDUeBFj1DbtuVchIRldpw==">
</div>
    <div id="fb-root">
    </div>
    <script type="text/javascript">
//<![CDATA[
Sys.WebForms.PageRequestManager._initialize('ctl00$ScriptManager', 'aspnetForm', [], [], [], 90, 'ctl00');
//]]>
</script>


            <div id="RepositionBody">
            <?= SiteHeader::render() ?>
            <?= SiteAlert::render() ?>
            <div class="forceSpace">&nbsp;</div>
            <div id="Body" style="width:970px;">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td align="left"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1" name="Whereami1">
                                    <div>
                                        <nobr>
                                            <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_LinkHome"
                                                class="linkMenuSink notranslate" href="/Forum/Default.aspx.php">ROBLOX
                                                Forum</a>
                                        </nobr>
                                    </div>
                                </span></td>
                            <td align="right"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1">
                                    <div id="forum-nav" style="text-align: right">
                                        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_HomeMenu"
                                            class="menuTextLink first" href="/Forum/Default.aspx.php">Home</a>
                                        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_SearchMenu"
                                            class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
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
                                <span class="normalTextSmallBold">Current time: </span><span class="normalTextSmall" id="client-time">Loading...</span>
                                <script type="text/javascript">
                                    (function updateClientTime() {
                                        function render() {
                                            try {
                                                var d = new Date();
                                                var s = d.toLocaleString(undefined, { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true });
                                                var el = document.getElementById('client-time');
                                                if (el) el.textContent = s;
                                            } catch (e) {}
                                        }
                                        render();
                                        setInterval(render, 60000);
                                    })();
                                </script>
                            </td>
                            <td align="right">
                                <span id="ctl00_cphRoblox_SearchRedirect">

                                    <span>
                                        <span class="normalTextSmallBold">Search Roblox Forums:</span>
                                        <input name="ctl00$cphRoblox$SearchRedirect$ctl00$SearchText" type="text"
                                            maxlength="50" id="ctl00_cphRoblox_SearchRedirect_ctl00_SearchText"
                                            class="notranslate" size="20">
                                        <input type="submit" name="ctl00$cphRoblox$SearchRedirect$ctl00$SearchButton"
                                            value="Go" id="ctl00_cphRoblox_SearchRedirect_ctl00_SearchButton"
                                            class="translate btn-control btn-control-medium forum-btn-control-medium">
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
                                <a class="forumTitle"
                                    href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?php echo htmlspecialchars($group['id']); ?>">
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
                                    <a class="forum-summary"
                                        href="/Forum/ShowForum.aspx?ForumID=<?php echo htmlspecialchars($forum['id']); ?>">
                                        <div class="forumTitle"><?php echo htmlspecialchars($forum['name']); ?></div>
                                        <div><?php echo htmlspecialchars($forum['description']); ?></div>
                                    </a>
                                </td>
                                <td class="forum-centered-cell" align="center"><span
                                        class="normalTextSmaller"><?php echo number_format($forum['threads_count']); ?></span>
                                </td>
                                <td class="forum-centered-cell" align="center"><span
                                        class="normalTextSmaller"><?php echo number_format($forum['posts_count']); ?></span>
                                </td>
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
    </form>
</body>

</html>