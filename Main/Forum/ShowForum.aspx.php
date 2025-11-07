<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteAlert;
$forum_id = isset($_GET['ForumID']) ? intval($_GET['ForumID']) : 0;
if ($forum_id === 0) {
    header("Location: /Forum/Default.aspx");
    exit();
}
$days = isset($_GET['days']) ? intval($_GET['days']) : 0;
$threads_per_page = 20;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $threads_per_page;
$stmt = $conn->prepare("SELECT f.id, f.name, f.description, f.group_id, fg.name as group_name FROM forums f JOIN forum_groups fg ON f.group_id = fg.id WHERE f.id = :id");
$stmt->execute(['id' => $forum_id]);
$forum = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$forum) {
    header("Location: /Forum/Default.aspx");
    exit();
}
$where_clause = "WHERE t.forum_id = :forum_id";
$params = ['forum_id' => $forum_id];
if ($days > 0) {
    $where_clause .= " AND t.last_post_at >= NOW() - INTERVAL :days DAY";
    $params['days'] = $days;
}
$count_stmt = $conn->prepare("SELECT COUNT(*) FROM threads t $where_clause");
$count_stmt->execute($params);
$total_threads = $count_stmt->fetchColumn();
$total_pages = max(1, ceil($total_threads / $threads_per_page));
$sql = "SELECT t.id, t.subject, t.user_id, u.username as author_name, t.replies_count, t.views_count, t.last_post_at, t.is_pinned, t.is_locked, t.is_popular, lp.username as last_poster_name FROM threads t JOIN users u ON t.user_id = u.id LEFT JOIN users lp ON t.last_post_user_id = lp.id $where_clause ORDER BY t.is_pinned DESC, t.last_post_at DESC LIMIT :limit OFFSET :offset";
$threads_stmt = $conn->prepare($sql);
foreach ($params as $key => $val) {
    $threads_stmt->bindValue(":$key", $val, PDO::PARAM_INT);
}
$threads_stmt->bindValue(":limit", $threads_per_page, PDO::PARAM_INT);
$threads_stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
$threads_stmt->execute();
$threads = $threads_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<!-- MachineID: WEB167 -->
<head id="ctl00_Head1"><title>
	<?= $site_properties['hostname'] ?>
</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css' />

<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___c7d63abcc3de510b8a7b8ab6d435f9b6_m.css' />
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" /><title>ROBLOX Forum</title>
    <link rel="stylesheet" href="/Forum/skins/default/style/default.css" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Content-Language" content="en-us" /><meta name="author" content="ROBLOX Corporation" /><meta id="ctl00_metadescription" name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." /><meta id="ctl00_metakeywords" name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    	<script type="text/javascript">

        var _gaq = _gaq || [];

		    _gaq.push(['_setAccount', 'UA-11419793-1']);
		    _gaq.push(['_setCampSourceKey', 'rbx_source']);
		    _gaq.push(['_setCampMediumKey', 'rbx_medium']);
		    _gaq.push(['_setCampContentKey', 'rbx_campaign']);
		        _gaq.push(['_setDomainName', 'roblox.com']);
		_gaq.push(['b._setAccount', 'UA-486632-1']);
		_gaq.push(['b._setCampSourceKey', 'rbx_source']);
		_gaq.push(['b._setCampMediumKey', 'rbx_medium']);
		_gaq.push(['b._setCampContentKey', 'rbx_campaign']);

		_gaq.push(['b._setDomainName', 'roblox.com']);
        
            _gaq.push(['b._setCustomVar', 1, 'Visitor', 'Anonymous', 2]);
            _gaq.push(['b._trackPageview']);    
        
        
        

		_gaq.push(['c._setAccount', 'UA-26810151-2']);
		_gaq.push(['c._setDomainName', 'roblox.com']);

		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();

	</script>
<div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer)\.roblox\.com|robloxlabs\.com)((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))" data-regex-flags="gm"></div><script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='https://code.jquery.com/jquery-1.2.3.min.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
<script type='text/javascript' src='http://js.rbxcdn.com/92d454a11b2b7266829922801d327151.js'></script>
<script type='text/javascript'>Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/1612c57544c7977e19cd15c824f7ecc3.js';Roblox.config.paths['Pages.CatalogShared'] = 'http://js.rbxcdn.com/209f2b781ea84e8d0332648ddf547d57.js';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/e8cbac58ab4f0d8d4c707700c9f97630.js';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/bbaeb48f3312bad4626e00c90746ffc0.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/7b436bae917789c0b84f40fdebd25d97.js';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/33d82b98045d49ec5a1f635d14cc7010.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/fbb86cf0752d23f389f983419d3085b4.js';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/8babd891cf420dfe3999b3824a0154cb.js';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/f2697119678d0851cfaa6c2270a727ed.js';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script><script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script><script type='text/javascript' src='http://js.rbxcdn.com/16994b0cbe9c1d943e0de0fade860343.js'></script>

<script type="text/javascript">
if (typeof(Roblox) === "undefined") { Roblox = {}; }
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
Roblox.Endpoints.Urls['/asset/'] = '/asset/';
Roblox.Endpoints.Urls['/client-status/set'] = '/client-status/set';
Roblox.Endpoints.Urls['/client-status'] = '/client-status';
Roblox.Endpoints.Urls['/game/'] = '/game/';
Roblox.Endpoints.Urls['/game/edit.ashx'] = '/game/edit.ashx';
Roblox.Endpoints.Urls['/game/getauthticket'] = '/game/getauthticket';
Roblox.Endpoints.Urls['/game/placelauncher.ashx'] = '/game/placelauncher.ashx';
Roblox.Endpoints.Urls['/game/report-stats'] = '/game/report-stats';
Roblox.Endpoints.Urls['/game/report-event'] = '/game/report-event';
Roblox.Endpoints.Urls['/chat/chat'] = '/chat/chat';
Roblox.Endpoints.Urls['/chat/party/setting'] = '/chat/party/setting';
Roblox.Endpoints.Urls['/chat/get.ashx'] = '/chat/get.ashx';
Roblox.Endpoints.Urls['/chat/party.ashx'] = '/chat/party.ashx';
Roblox.Endpoints.Urls['/chat/send.ashx'] = '/chat/send.ashx';
Roblox.Endpoints.Urls['/chat/utility.ashx'] = '/chat/utility.ashx';
Roblox.Endpoints.Urls['/chat/friendhandler.ashx'] = '/chat/friendhandler.ashx';
Roblox.Endpoints.Urls['/presence/users'] = '/presence/users';
Roblox.Endpoints.Urls['/presence/user'] = '/presence/user';
Roblox.Endpoints.Urls['/friends/list'] = '/friends/list';
Roblox.Endpoints.Urls['/navigation/getCount'] = '/navigation/getCount';
Roblox.Endpoints.Urls['/catalog/browse.aspx'] = '/catalog/browse.aspx';
Roblox.Endpoints.Urls['/catalog'] = '/catalog';
Roblox.Endpoints.Urls['/catalog/'] = '/catalog/';
Roblox.Endpoints.Urls['/catalog/html'] = '/catalog/html';
Roblox.Endpoints.Urls['/catalog/json'] = '/catalog/json';
Roblox.Endpoints.Urls['/catalog/contents'] = '/catalog/contents';
Roblox.Endpoints.Urls['/catalog/lists.aspx'] = '/catalog/lists.aspx';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/image'] = '/asset-hash-thumbnail/image';
Roblox.Endpoints.Urls['/asset-hash-thumbnail/json'] = '/asset-hash-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail-3d/json'] = '/asset-thumbnail-3d/json';
Roblox.Endpoints.Urls['/asset-thumbnail/image'] = '/asset-thumbnail/image';
Roblox.Endpoints.Urls['/asset-thumbnail/json'] = '/asset-thumbnail/json';
Roblox.Endpoints.Urls['/asset-thumbnail/url'] = '/asset-thumbnail/url';
Roblox.Endpoints.Urls['/asset/request-thumbnail-fix'] = '/asset/request-thumbnail-fix';
Roblox.Endpoints.Urls['/avatar-thumbnail-3d/json'] = '/avatar-thumbnail-3d/json';
Roblox.Endpoints.Urls['/avatar-thumbnail/image'] = '/avatar-thumbnail/image';
Roblox.Endpoints.Urls['/avatar-thumbnail/json'] = '/avatar-thumbnail/json';
Roblox.Endpoints.Urls['/avatar-thumbnails'] = '/avatar-thumbnails';
Roblox.Endpoints.Urls['/avatar/request-thumbnail-fix'] = '/avatar/request-thumbnail-fix';
Roblox.Endpoints.Urls['/bust-thumbnail/json'] = '/bust-thumbnail/json';
Roblox.Endpoints.Urls['/group-thumbnails'] = '/group-thumbnails';
Roblox.Endpoints.Urls['/headshot-thumbnail/json'] = '/headshot-thumbnail/json';
Roblox.Endpoints.Urls['/item-thumbnails'] = '/item-thumbnails';
Roblox.Endpoints.Urls['/outfit-thumbnail/json'] = '/outfit-thumbnail/json';
Roblox.Endpoints.Urls['/place-thumbnails'] = '/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/asset/'] = '/thumbnail/asset/';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshot'] = '/thumbnail/avatar-headshot';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshots'] = '/thumbnail/avatar-headshots';
Roblox.Endpoints.Urls['/thumbnail/user-avatar'] = '/thumbnail/user-avatar';
Roblox.Endpoints.Urls['/thumbnail/resolve-hash'] = '/thumbnail/resolve-hash';
Roblox.Endpoints.Urls['/thumbnail/place'] = '/thumbnail/place';
Roblox.Endpoints.Urls['/thumbnail/get-asset-media'] = '/thumbnail/get-asset-media';
Roblox.Endpoints.Urls['/thumbnail/remove-asset-media'] = '/thumbnail/remove-asset-media';
Roblox.Endpoints.Urls['/thumbnail/set-asset-media-sort-order'] = '/thumbnail/set-asset-media-sort-order';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails'] = '/thumbnail/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails-partial'] = '/thumbnail/place-thumbnails-partial';
Roblox.Endpoints.Urls['/thumbnail_holder/g'] = '/thumbnail_holder/g';
Roblox.Endpoints.Urls['/groups/getprimarygroupinfo.ashx'] = '/groups/getprimarygroupinfo.ashx';
Roblox.Endpoints.addCrossDomainOptionsToAllRequests = true;
</script>
<script type="text/javascript">
if (typeof(Roblox) === "undefined") { Roblox = {}; }
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
</script>
</head>
<body class="">

    <script type="text/javascript">Roblox.XsrfToken.setToken('XZKT5whiDQ+X');</script>
 
    <script type="text/javascript">
        if (top.location != self.location) {
            top.location = self.location.href;
        }
    </script>
  
<style type="text/css">
    
</style>
<form name="aspnetForm" method="post" action="/Forum/ShowForum.aspx?ForumID={{ $forum->id }}" id="aspnetForm" class="nav-container no-gutter-ads">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="SRxB/1NNdCVCGq04n6JXIrB/aFSDTANC+Q1YfrerWvPereCjtlZdgNe8NQq4o4z4QuzBTSbTR+mvzS6/hu+MSmYU4O01sW/iixn/XPT9dxXi49yfsxJuB2QmhouozaVHdUh+8qjK9G6lHEQc9eheYv3X3RLG8ygAJqY4ICVcVqfheZ552V16iMfkhy2QDpacEW+5gBch9CnrKG/kGV7vDJzGpMhdUdr+LzVKZ0aM7B8uj4D4/A2WvtxTOas9l1nD0PWDqGOfCmTVEhCfiFvDynMPfAcDCTJfJSzl22fR5xPZeOft+y547qIJdzHmmhjPHqVc4WRODd3dQwO4uCF88L/31fZwNqZj5YzsqK+R0sYwg2Rj/h02lFslRrVrBiCtvUmvthGigXNS7d6HzBCNUL6nsNVNOL59BSVvkXuIFkc03p1UkiI6N//E47KiQSsFBxquF9K1v1SnlGMa2UTgdZ+KrTdBzemU+UhkcoPQT7+xv+/MjzMPJzGy6wx/m6uQJeGsj8rjMPBfTGz0AreTkr8DUxw=" />
</div>


<script src="/ScriptResource.axd?d=mKu1u_e4FVGgmK8s2XdDDkS4dvEgnubLSowkgmrYO8FzFyhEwx-wq0N42AlkBzmrgxF5pfpxTOunSty3UekLAGtuADT8Y2DCEXDtl8GFg0q93o_7l5fas6rCKurumOZsrNPU1qpEZCJ1nTuHqeZd4M-zOJssN_kCCpMom3AbBLaRdLZL5_un9YatxA2OOR2Xbw4QQrghXn4CHXeY3ZjD9lcDOT8D_W92orX3QTURLpldOc2UI_kZrFW4KO2edM9J6__3oZwbeopLM_TBuLA7llvpjtWtjzJO4rZgwiIUcShgPOaFtF8W0vfWGuQqfXom0M2KjnEtvtwI8lxZVJZmVabQ0vgOSSslxg79bS6invicDwWozJkfGDRMlXmyGMD0uclsnn4Tkr9VkX38oB8Des5rjNwUegVkudjqs4Jt5ZHrMg_v0" type="text/javascript"></script>
<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="978321BF" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="6sSXb+k1AoRdjmihg+Sy+p5TaeP0uPah2FfGF7SRZwVLcIm7BvVEV+LO0jElUtfXZLyNQV9XfTc66lLJSj1aF2PSX+02U8uiDg/PWm3i4/3nqNLCVHLf6wh6rAyywuGJFoNwGHDdJ7RUbBcOYwNBt5DkTWupZq4DfoGCHc/+LcNPZuPBQavgkSGSabEQrohoIlno/KGQ6NlFqimfT3vJfg5CZigSRntpBiPrZbxrfKDL+V3PyJkGewbXouixfldlY77oe6Itst8TScFf1Su0fwJ0Y2PGgafLjI2tLKXFux7/1X2njMsBm3+Mk1U7K7hxAIewhIGc0ZsPnhWJsgQQN10SF3957uRmwk3an4G09To/uMsVqz9jxMYk1MKEIXNambikX73uYg+fyQ1WNjl0l8e28a6JiEOVHpjMTXksscL+Qar+a78aQsoQ6pArUKod7bdz3eDOiXWL658amfHKHjXLVjs=" />
</div>
    <div id="fb-root">
    </div>
    
    
         
    
    
    

<?= SiteHeader::render() ?>
    <div id="MasterContainer" >
        

<script type="text/javascript">
    $(function(){
        function trackReturns() {
            function dayDiff(d1, d2) {
                return Math.floor((d1-d2)/86400000);
            }
            if (!localStorage) {
                return false;
            }

            var cookieName = 'RBXReturn';
            var cookieOptions = {expires:9001};
            var cookieStr = localStorage.getItem(cookieName) || "";
            var cookie = {};

            try {
                cookie = JSON.parse(cookieStr);
            } catch (ex) {
                // busted cookie string from old previous version of the code
            }

            try {
                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                    localStorage.setItem(cookieName, JSON.stringify({ ts: new Date().toDateString() }));
                    return false;
                }
            } catch (ex) {
                return false;
            }

            var daysSinceFirstVisit = dayDiff(new Date(), new Date(cookie.ts));
            if (daysSinceFirstVisit == 1 && typeof cookie.odr === "undefined") {
                RobloxEventManager.triggerEvent('rbx_evt_odr', {});
                cookie.odr = 1;
            }
            if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
                RobloxEventManager.triggerEvent('rbx_evt_sdr', {});
                cookie.sdr = 1;
            }
            try {
                localStorage.setItem(cookieName, JSON.stringify(cookie));
            } catch (ex) {
                return false;
            }
        }

        GoogleListener.init();


    
        RobloxEventManager.initialize(true);
        RobloxEventManager.triggerEvent('rbx_evt_pageview');
        trackReturns();
        

    
        RobloxEventManager._idleInterval = 450000;
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_ftp');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_fmp');
        RobloxEventManager.startMonitor();
        

    });

</script>



        <script type="text/javascript">Roblox.FixedUI.gutterAdsEnabled=false;</script>

        

        <div id="Container">
            
            
        </div>

		
<div id="AdvertisingLeaderboard" >
    

    <iframe allowtransparency="true"
            frameborder="0"
            height="110"
            scrolling="no"
            src="/userads/1"
            width="728"
            data-js-adtype="iframead"></iframe>

</div>

        
        
        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
		<?= SiteAlert::render() ?>
        
        
        
        
        <div id="BodyWrapper">
            
            <div id="RepositionBody">
                <div id="Body" style='width:970px;'>
                    

	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
		<tr valign="top">
			<!-- left column -->
			<td class="LeftColumn">&nbsp;&nbsp;&nbsp;</td>

			<!-- center column -->
			<td id="ctl00_cphRoblox_CenterColumn" class="CenterColumn">
				<br>
				<span id="ctl00_cphRoblox_ThreadView1">

<table cellPadding="0" width="100%">
	<tr>
		<td align="left"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1" NAME="Whereami1">
<div>
    <nobr>
        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx">ROBLOX Forum</a>
    </nobr>
    <nobr>
        <span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_ForumGroupSeparator" class="normalTextSmallBold"> » </span>
        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_LinkForumGroup" class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?= $forum['group_id'] ?>"><?= $forum['group_name'] ?></a>
    </nobr>
    <nobr>
        <span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_ForumSeparator" class="normalTextSmallBold"> » </span>
        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami1_ctl00_LinkForum" class="linkMenuSink notranslate" href="/Forum/ShowForum.aspx?ForumID=<?= $forum['id'] ?>"><?= $forum['name'] ?></a>
    </nobr>
</div></span></td>
        <td align="right"><span id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1">

<div id="forum-nav" style="text-align: right">
	<a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
	<a id="ctl00_cphRoblox_ThreadView1_ctl00_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
	
	
	
	
	
	
	
</div>
</span></td>
	</tr>
	<tr>
		<td>
			&nbsp;
		</td>
	</tr>
	<tr style="padding-bottom:5px;">
		<td vAlign="bottom" align="left">
		    <a id="ctl00_cphRoblox_ThreadView1_ctl00_NewThreadLinkTop" class="btn-control btn-control-medium verified-email-act" href="/Forum/AddPost.aspx?ForumID={{ $forum->id }}">
				New Thread
			</a>
		</td>
		<td align="right">
		    <span class="normalTextSmallBold">Search this forum: </span>
			<input name="ctl00$cphRoblox$ThreadView1$ctl00$Search" type="text" id="ctl00_cphRoblox_ThreadView1_ctl00_Search" />
			<input type="submit" name="ctl00$cphRoblox$ThreadView1$ctl00$SearchButton" value=" Go " id="ctl00_cphRoblox_ThreadView1_ctl00_SearchButton" class="translate btn-control btn-control-medium forum-btn-control-medium" />
        </td>
	</tr>
	<tr>
		<td vAlign="top" colSpan="2">
		    <div style="height:7px"></div>
		    <table id="ctl00_cphRoblox_ThreadView1_ctl00_ThreadList" class="tableBorder" cellspacing="1" cellpadding="3" border="0" style="width:100%;">
	<tr class="forum-table-header">
		<th align="left" colspan="3" style="height:25px;">&nbsp;Subject&nbsp;</th><th align="left" style="white-space:nowrap;">&nbsp;Author&nbsp;</th><th align="center">&nbsp;Replies&nbsp;</th><th align="center">&nbsp;Views&nbsp;</th><th align="center" style="white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
	</tr>
	<?php if (empty($threads)): ?>
                    <tr><td colspan="7" align="center">No threads found.</td></tr>
                <?php else: ?>
                    <?php foreach ($threads as $thread):
                        $icon_name = 'thread';
                        if ($thread['is_locked']) $icon_name = 'locked';
                        elseif ($thread['is_popular']) $icon_name = 'popular';
                        if ($thread['is_pinned']) $icon_name = $thread['is_locked'] ? 'pinned-locked' : 'thread';
                        ?>
                    <tr class="forum-table-row">
		<td align="center" valign="middle" style="width:25px;"><img title="Popular post (Not Read)" src="/images/Forums/<?= $icon_name ?>-unread.png" style="border-width:0px;" /></td><td class="notranslate" style="height:25px;"><a class="post-list-subject" href="/Forum/ShowPost.aspx?PostID=<?= $thread['id'] ?>"><div class="thread-link-outer-wrapper">
			<div class="thread-link-container notranslate">
				<?= htmlspecialchars($thread['subject']) ?>
			</div>
		</div></a></td><td class="notranslate" style="width:80px;width:90px;padding-right:12px;"></td><td align="left" style="width:100px;"><a class="post-list-author notranslate" href="/User.aspx?ID=<?= $thread['user_id'] ?>"><div class="thread-link-outer-wrapper">
			<div class="normalTextSmaller thread-link-container">
				<?= htmlspecialchars($thread['author_name']) ?>
			</div>
		</div></a></td><td align="center" style="width:50px;">
		                        <span class="normalTextSmaller"><?= number_format($thread['replies_count']) ?></span></td><td align="center" style="width:50px;"><span class="normalTextSmaller"><?= number_format($thread['views_count']) ?></span></td><td align="center" style="width:100px;white-space:nowrap;"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=<?= $thread['id'] ?>#last"><div>
                                		<span class="normalTextSmaller"><b><?= date('n/j/Y g:i A', strtotime($thread['last_post_at'])) ?></b></span>
                                	</div><div class="normalTextSmaller notranslate"><?= htmlspecialchars($thread['last_poster_name'] ?? 'N/A') ?></div></a></td>
                                </tr>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
				<tr class="forum-table-footer">
		<td colspan="7">&nbsp;</td>
	</tr>
</table>
            <span id="ctl00_cphRoblox_ThreadView1_ctl00_Pager"><table cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
	<tr>
		<td><span class="normalTextSmallBold">Page <?= $page ?> of <?= $total_pages ?></span></td>
		<td align="right">
		<span>
		<span class="normalTextSmallBold">Goto to page: </span>
		<?php for ($i = 1; $i <= $lastPage; $i++): ?>
		    <?php if ($page < $total_pages): ?>
		        <span class="normalTextSmallBold">[<?php echo $i; ?>]</span>
		    <?php else: ?>
		        <a class="normalTextSmallBold" href="?ForumID=<?php echo $forum['id']; ?>&page=<?php echo $i; ?>">
 		           <?php echo $i; ?>
		        </a>
		    <?php endif; ?>

		    <?php if ($i < min($lastPage, 3)): ?>
		        <span class="normalTextSmallBold">, </span>
		    <?php endif; ?>
		<?php endfor; ?>
		</span></td>
	</tr>
</table></span>
            
            
		</td>
	</tr>
	<tr>
		<td colspan="2">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td align="left" valign="top">
			<span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2" NAME="Whereami2">
<div>
    <nobr>
        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx">ROBLOX Forum</a>
    </nobr>
    <nobr>
        <span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_ForumGroupSeparator" class="normalTextSmallBold"> » </span>
        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_LinkForumGroup" class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?= $forum['group_id'] ?>"><?= $forum['group_name'] ?></a>
    </nobr>
    <nobr>
        <span id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_ForumSeparator" class="normalTextSmallBold"> » </span>
        <a id="ctl00_cphRoblox_ThreadView1_ctl00_Whereami2_ctl00_LinkForum" class="linkMenuSink notranslate" href="/Forum/ShowForum.aspx?ForumID=<?= $forum['id'] ?>"><?= $forum['name'] ?></a>
    </nobr>
</div></span>
			
		</td>
		<td align="right">
<form method="GET" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="ForumID" value="<?php echo htmlspecialchars($forum->id); ?>">
    <span class="normalTextSmallBold">Display threads for: </span>
    <select onchange="location.href='?ForumID=<?php echo htmlspecialchars($forum->id); ?>&days=' + this.value;">
        <option value="0" <?php echo ($days == 0 ? 'selected' : ''); ?>>All Days</option>
        <option value="1" <?php echo ($days == 1 ? 'selected' : ''); ?>>Today</option>
        <option value="3" <?php echo ($days == 3 ? 'selected' : ''); ?>>Past 3 Days</option>
        <option value="7" <?php echo ($days == 7 ? 'selected' : ''); ?>>Past Week</option>
        <option value="14" <?php echo ($days == 14 ? 'selected' : ''); ?>>Past 2 Weeks</option>
        <option value="30" <?php echo ($days == 30 ? 'selected' : ''); ?>>Past Month</option>
        <option value="90" <?php echo ($days == 90 ? 'selected' : ''); ?>>Past 3 Months</option>
        <option value="180" <?php echo ($days == 180 ? 'selected' : ''); ?>>Past 6 Months</option>
        <option value="360" <?php echo ($days == 360 ? 'selected' : ''); ?>>Past Year</option>
    </select>
</form>

			<span class="normalTextSmallBold">
				
			</span>
		</td>
	</tr>
	<tr>
		<td colSpan="2">&nbsp;</td>
	</tr>
</table>
</span>
			</td>
<script>
    document.getElementById('daysSelect').addEventListener('change', function () {
        document.getElementById('daysForm').submit();
    });
</script>
			<td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>	
            
            <!-- right column -->
            <td Width="160px" style="padding-top:88px;">
                

    <iframe allowtransparency="true"
            frameborder="0"
            height="612"
            scrolling="no"
            src="/userads/2"
            width="160"
            data-js-adtype="iframead"></iframe>

            </td>
            <td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</table>
    
    
                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
        </div>
        <?= SiteFooter::render() ?>
</body>                
</html>
