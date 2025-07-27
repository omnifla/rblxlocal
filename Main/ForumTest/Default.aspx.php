<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
$groups = $conn->query('SELECT id, name FROM forum_groups ORDER BY sort_order ASC')->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<!-- MachineID: WEB142 -->
<head id="ctl00_Head1"><meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" /><title>
	<?= $site_properties['Title'] ?> Forum
</title>
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css' />
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___09c4a1b67a03bbb716c6f0c4a2a425b4_m.css' />
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" /><title><?= $site_properties['Title'] ?> Forum</title>
    <link rel="stylesheet" href="/Forum/skins/default/style/default.css" type="text/css" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Content-Language" content="en-us" /><meta name="author" content="ROBLOX Corporation" /><meta id="ctl00_metadescription" name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." /><meta id="ctl00_metakeywords" name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />	<script type="text/javascript">

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
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

<script type='text/javascript' src='http://js.rbxcdn.com/85b569de636868c8c77cdd1da39f2a88.js'></script>
<script type='text/javascript'>Roblox.config.externalResources = ['/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = 'http://js.rbxcdn.com/29cf397a226a92ca602cb139e9aae7d7.js';Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/7123e398c0433de33356ac718bab90d5.js';Roblox.config.paths['Pages.CatalogShared'] = 'http://js.rbxcdn.com/4eb48eec34ca711d5a7b08a4291ac753.js';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/9b1b88b531c486003bbf39ae61963c27.js';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/a404577733d1b68e3056a8cd3f31614c.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/d83d02dd89808934b125fa21c362bcb9.js';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/3e692c7b60e1e28ce639184f793fdda9.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/e8b579b8e31f8e7722a5d10900191fe7.js';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/f676cf25d820c731b5adb4bf362bcd90.js';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/08e1942c5b0ef78773b03f02bffec494.js';Roblox.config.paths['Widgets.Suggestions'] = 'http://js.rbxcdn.com/a63d457706dfbc230cf66a9674a1ca8b.js';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script><script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true, 'internalEventListenerPixelEnabled': true});
    });
</script>
<script type='text/javascript' src='http://js.rbxcdn.com/0c66ac0d28c87923e08876fae2518a92.js'></script>
    <script type="text/javascript">
function Roblox_Forums_Middle_728x90_RTP(estimate){rtp['/1015347/Roblox_Forums_Middle_728x90'] = rp_valuation.estimate;}
var rtp = rtp || {};
oz_api="valuation";oz_site="9874/18868";oz_zone="58960";oz_ad_slot_size="728x90";oz_callback=Roblox_Forums_Middle_728x90_RTP;
</script><script type="text/javascript" src="http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script><script>

function Roblox_Forums_Right_160x600_RTP(estimate){rtp['/1015347/Roblox_Forums_Right_160x600'] = rp_valuation.estimate;}
var rtp = rtp || {};
oz_api="valuation";oz_site="9874/18868";oz_zone="58960";oz_ad_slot_size="160x600";oz_callback=Roblox_Forums_Right_160x600_RTP;
</script><script type="text/javascript" src="http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script><script>

        googletag.cmd.push(function() {
            Roblox = Roblox || {};
            Roblox.AdsHelper = Roblox.AdsHelper || {};
            Roblox.AdsHelper.slots = [];
            Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Forums_Middle_728x90", [728, 90], "3536373438363235").addService(googletag.pubads()), id: "3536373438363235", path: "/1015347/Roblox_Forums_Middle_728x90"});
Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Forums_Right_160x600", [160, 600], "3631363436333936").addService(googletag.pubads()), id: "3631363436333936", path: "/1015347/Roblox_Forums_Right_160x600"});
 
            for (var key in Roblox.AdsHelper.slots) {
                var slot = Roblox.AdsHelper.slots[key].slot;
                var id = Roblox.AdsHelper.slots[key].id;
                var path = Roblox.AdsHelper.slots[key].path;
                
                     slot.setTargeting('pos', path);
                     slot.setTargeting('tier', rtp[path].tier);
                if (slot.renderEnded != "undefined") {
                    (function(slot, id)
                    {
                        slot.renderEndedOld = slot.renderEnded;
                        slot.renderEnded = function() {
                            slot.renderEndedOld();
                            if ($('#' + id + '.gutter').css('display') == "none") {
                                $(document).trigger("GuttersHidden");
                            }
                            if ($('#' + id + '.filmstrip').css('display') == "none") {
                                $(document).trigger("FilmStripHidden");
                            }
                        };    
                    }(slot, id));
                }
            }

            googletag.pubads().setTargeting("Age", "Unknown");	
                googletag.pubads().setTargeting("Env",  "Production");
            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.enableServices();
        });
    </script>  
</head>
<body class="">

    <script type="text/javascript">Roblox.XsrfToken.setToken('');</script>
 
    <script type="text/javascript">
        if (top.location != self.location) {
            top.location = self.location.href;
        }
    </script>
  
<style type="text/css">
    
</style>
<form name="aspnetForm" method="post" action="/Forum/Default.aspx" id="aspnetForm">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJMTU1MzUyNTM2D2QWAmYPZBYCAgEQFgIeBmFjdGlvbgUTL0ZvcnVtL0RlZmF1bHQuYXNweGQWAgIHDw8WAh4HVmlzaWJsZWhkZBgFBSNjdGwwMCRMZWZ0R3V0dGVyQWQkQXN5bmNBZE11bHRpVmlldw8PZAIDZAUjY3RsMDAkcmJ4R29vZ2xlQW5hbHl0aWNzJE11bHRpVmlldzEPD2RmZAUvY3RsMDAkY3BoQmFubmVyQWQkRm9ydW1zQmFubmVyJEFzeW5jQWRNdWx0aVZpZXcPD2QCA2QFJGN0bDAwJFJpZ2h0R3V0dGVyQWQkQXN5bmNBZE11bHRpVmlldw8PZAIDZAUxY3RsMDAkY3BoUm9ibG94JEZvcnVtc1NreXNjcmFwZXIkQXN5bmNBZE11bHRpVmlldw8PZAIDZODWb2juoWDZrxYDGO3AnaV6T/Q4" />
</div>


<script src="/ScriptResource.axd?d=zveSJmDLrnP7hSV3H79u5N0IlhxrL-3ksCS_M2ah6gZUw5HC66wCsgZXy7p80D6hw_PwnN7Rd6zAkv9f8S_L9d4al408LW5QrmGY_2jFMX6FwRdVlJO8XRscQ3COI561OmC4skLSQCmRisocHVNIL7YgLCSb8ctb0lLk0NB40xbolxqend-N8hdqLhE9mJoL7LQUX8bQw0wJ4Ih9dK4sOnwuWG4KobaUAsFSOouA8_aqGlYvt4_7qdULXSb2E3OHHSOkgoR_5uDKTwBXAWW0nsBWqE81Fo806h46NIIMSrergbZpjOJCMOPs9Eszb1OhJWY1OVf3mSGPnPl0yN2ZDSkHtSN4EWGJAH0IkHhHVkfPr0JFKYBNrc6SDZai2x6-ksTzQH_LFNUQhgCnstAvSWzgM0SRKC-ZpBdtTFP3NHuoARm3hDZ0LBUYlIy6fYNo21isgQ2" type="text/javascript"></script>
<div>

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWAwKmk9jRDwKhvZDLCwK9hOilCgiNJqE0suSk+YHc8gXA9ins4DV2" />
</div>
    <div id="fb-root">
    </div>
    
    
         
    
    
    
        <div class=""><div class="">
    <div id="MasterContainer" >
           
                   


<script type="text/javascript">
$(function(){
    function trackReturns() {
	    function dayDiff(d1, d2) {
		    return Math.floor((d1-d2)/86400000);
	    }

	    var cookieName = 'RBXReturn';
	    var cookieOptions = {expires:9001};
        var cookie = $.getJSONCookie(cookieName);

	    if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
	        $.setJSONCookie(cookieName, { ts: new Date().toDateString() }, cookieOptions);
		    return;
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
	
	    $.setJSONCookie(cookieName, cookie, cookieOptions);
    }

    
        RobloxListener.restUrl = window.location.protocol + "//" + "roblox.com/Game/EventTracker.ashx";
        RobloxListener.init();
    
    
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
            
                
                                                            
<?= SiteHeader::render() ?>
<script type="text/javascript">
    $(function () {
        $('.more-list-item').bind('showDropDown', function () {
            var maxWidth = $('#navigation-menu .dropdownnavcontainer').width();
            $('a.dropdownoption span').each(function (index, elem) {
                elem = $(elem);
                if (elem.outerWidth() > maxWidth) {
                    maxWidth = elem.outerWidth();
                }
            });
            maxWidth = maxWidth + 5;
            $('#navigation-menu .dropdownoption').each(function (index, elem) {
                elem = $(elem);
                if (elem.width() < maxWidth) {
                    elem.width(maxWidth);
                }
            });
        });
    });
    
    
</script>

                <style>
                    html {
                        background: #123f83;
                    }
                </style>
                
        </div>

        
            

        <div class="forceSpace">&nbsp;</div>
<div id="AdvertisingLeaderboard" >
    
            <div style="width: 728px">
    <span id='3536373438363235' class="GPTAd banner" data-js-adtype="gptAd">
        <script type="text/javascript">
            googletag.cmd.push(function () {
                googletag.display("3536373438363235");
            });
        </script>
    </span>
    <div class="ad-annotations " style="width: 728px">
        <span class="ad-identification">Advertisement
            <span> - </span>
            <a href="" class="UpsellAdButton" title="Click to learn how to remove ads!">Why am I seeing ads?</a>
        </span>
            <a class="BadAdButton" href="/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
    </div>
</div>

</div>


        <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
        
        <div id="BodyWrapper">
            <div id="RepositionBody">
                <div id="Body" style='width:970px;'>
                    

	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
		<tr valign="top">
			
            <!-- left column -->
			<td class="LeftColumn">&nbsp;&nbsp;&nbsp;</td>
			
            <!-- center column -->
			<td id="ctl00_cphRoblox_CenterColumn" width="95%" class="CenterColumn">
				<br>
            	<span id="ctl00_cphRoblox_NavigationMenu2">

<div id="forum-nav" style="text-align: right">
	<a id="ctl00_cphRoblox_NavigationMenu2_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
	<a id="ctl00_cphRoblox_NavigationMenu2_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>
	
	
	
	
	
	
	
</div>
</span>
				<br>
				<table Cellpadding="0" Cellspacing="2" width="100%">
					<Tr>
						<td align="left">
							<span class="normalTextSmallBold">Current time: </span><span class="normalTextSmall">Apr 4, 10:22 AM</span>
						</td>
						<td align="right">
						    <span id="ctl00_cphRoblox_SearchRedirect">

<span>
    <span class="normalTextSmallBold">Search Roblox Forums:</span>
    <input name="ctl00$cphRoblox$SearchRedirect$ctl00$SearchText" type="text" maxlength="50" id="ctl00_cphRoblox_SearchRedirect_ctl00_SearchText" class="notranslate" size="20" />
    <input type="submit" name="ctl00$cphRoblox$SearchRedirect$ctl00$SearchButton" value="Go" id="ctl00_cphRoblox_SearchRedirect_ctl00_SearchButton" class="translate btn-control btn-control-medium forum-btn-control-medium" />
</span></span>
							
						</td>
					</Tr>
				</table>
                <div style="height:7px;"></div>
				<table cellpadding="2" cellspacing="1" border="0" width="100%" class="table"><tr class="table-header forum-table-header">
	<th class="first" colspan="2"><a id="ctl00_cphRoblox_ForumGroupRepeater1_ctl01_GroupTitle" class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID=1">ROBLOX</a></th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th><th style="width:135px;white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=46"><div class="forumTitle">
		All Things ROBLOX
	</div><div>
		The area for discussions purely about ROBLOX – the features, the games, and company news.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">488,203</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">3,061,784</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129805323#129808857"><span class="normalTextSmaller"><div>
		<b>10:18 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">thxamillon</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=14"><div class="forumTitle">
		Help (Technical Support and Account Issues)
	</div><div>
		Seeking account or technical help? Post your questions here.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">167,361</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">732,856</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=113720767#129808943"><span class="normalTextSmaller"><div>
		<b>10:20 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">Thegamemasters1</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=52"><div class="forumTitle">
		Video Creations with ROBLOX
	</div><div>
		Specifically for videos recorded in the ROBLOX game. Use this forum to announce your Twitch.tv or YouTube channel, and to find actors, set builders, and other contributors for your video project.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">1,428</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">7,277</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129797683#129808926"><span class="normalTextSmaller"><div>
		<b>10:19 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">C0MBATLEADER</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=21"><div class="forumTitle">
		Suggestions & Ideas
	</div><div>
		Do you have a suggestion and ideas for ROBLOX? Share your feedback here.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">377,788</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">3,484,306</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129804811#129808952"><span class="normalTextSmaller"><div>
		<b>10:20 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">C0MBATLEADER</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=54"><div class="forumTitle">
		BLOXFaires Around the Globe
	</div><div>
		ROBLOX is going to be at various Maker Faires and conferences around the globe. Discuss those events here!
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">157</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">526</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129807015#129807874"><span class="normalTextSmaller"><div>
		<b>09:58 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">richman3692</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=43"><div class="forumTitle">
		ROBLOX Contests
	</div><div>
		Get involved with ROBLOX Contests! We're discussing ongoing and future contests in this forum.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">16,847</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">111,243</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129807842#129807842"><span class="normalTextSmaller"><div>
		<b>09:57 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">GodOfFrost</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=44"><div class="forumTitle">
		I Made That
	</div><div>
		Calling all creative ROBLOXians! Model builders, clothing creators, decal artists and re-texturers - this is your forum. 
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">38,965</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">140,988</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129807315#129807315"><span class="normalTextSmaller"><div>
		<b>09:43 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">thechubbymonkey</div></span></a></td>
</tr><tr class="table-header forum-table-header">
	<th class="first" colspan="2"><a id="ctl00_cphRoblox_ForumGroupRepeater1_ctl02_GroupTitle" class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID=8">Club Houses</a></th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th><th style="width:135px;white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=13"><div class="forumTitle">
		ROBLOX Talk
	</div><div>
		A popular hangout where ROBLOXians talk about various topics.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">4,098,182</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">29,913,914</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129808554#129808818"><span class="normalTextSmaller"><div>
		<b>10:17 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">essentially</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=18"><div class="forumTitle">
		Off Topic
	</div><div>
		When no other forum makes sense for your post, Off Topic will help it make even less sense.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">3,709,740</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">25,140,839</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129808920#129808932"><span class="normalTextSmaller"><div>
		<b>10:20 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">BurritoMonster1</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=32"><div class="forumTitle">
		Clans & Guilds
	</div><div>
		Talk about what’s going on in your Clans, Groups, Companies, and Guilds, and about the Groups feature in general.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">1,530,667</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">12,822,133</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129808765#129808873"><span class="normalTextSmaller"><div>
		<b>10:18 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">sebe30</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=35"><div class="forumTitle">
		Let's Make a Deal
	</div><div>
		A fast paced community dedicated to mastering the Limited Trades and Sales market, and divining the subtleties of the ROBLOX Currency Exchange.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">3,780,148</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">24,220,618</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129808623#129808938"><span class="normalTextSmaller"><div>
		<b>10:20 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">letsmakedeal</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=45"><div class="forumTitle">
		Global Chat
	</div><div>
		This forum is the place to discuss the country you are from, world travel, find online pen pals.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">13,426</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">152,323</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129695722#129808600"><span class="normalTextSmaller"><div>
		<b>10:13 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">DarakkenValskovycz</div></span></a></td>
</tr><tr class="table-header forum-table-header">
	<th class="first" colspan="2"><a id="ctl00_cphRoblox_ForumGroupRepeater1_ctl03_GroupTitle" class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID=9">Game Creation and Development</a></th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th><th style="width:135px;white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=19"><div class="forumTitle">
		Building Helpers
	</div><div>
		Learn the ins and outs of building structures in ROBLOX. Share your techniques with other builders, discuss designs, and draft plans. Help others!
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">140,306</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">722,783</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=107812821#129808997"><span class="normalTextSmaller"><div>
		<b>10:21 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">smurf279</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=20"><div class="forumTitle">
		Scripting Helpers
	</div><div>
		Need help with a script you are writing? Need to edit an existing script? This is the place to share your 1337 Lua programming skills and help others.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">371,191</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">2,577,429</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129803013#129808860"><span class="normalTextSmaller"><div>
		<b>10:18 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">cntkillme</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=40"><div class="forumTitle">
		Game Design
	</div><div>
		The place to discuss about the novel game ideas that you are possibly working on. This is not the place to hire people nor post help requests. 
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">31,284</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">190,241</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=116159166#129808295"><span class="normalTextSmaller"><div>
		<b>10:06 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">ShadowTheHeddgehog</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=37"><div class="forumTitle">
		Game Test
	</div><div>
		This is the place to post about www.gametest1.roblox.com about the ROBLOX game and Studio. [Note: Test servers may not be up all the time.]
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">8,859</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">60,171</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129802598#129802598"><span class="normalTextSmaller"><div>
		<b>07:32 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">Workteam</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=36"><div class="forumTitle">
		Website Test
	</div><div>
		Post about sitetest.roblox.com about ROBLOX website features here. [Note: Test servers may not be up all the time.]
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">11,646</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">67,430</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=99483713#129798057"><span class="normalTextSmaller"><div>
		<b>05:04 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">kingbed11</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=41"><div class="forumTitle">
		ROBLOX Mobile
	</div><div>
		Discuss mobile versions of the ROBLOX website, the iPhone app, and playing ROBLOX on the iPad.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">5,430</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">41,246</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=84207397#129808379"><span class="normalTextSmaller"><div>
		<b>10:08 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">dylanb7</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=39"><div class="forumTitle">
		ROBLOX Studio
	</div><div>
		This is the place to post about ROBLOX Studio for Mac and Windows.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">12,115</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">63,107</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129754850#129806774"><span class="normalTextSmaller"><div>
		<b>09:30 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">Maisuro</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=33"><div class="forumTitle">
		Scripters
	</div><div>
		This is the place for discussion about scripting. Anything about scripting that is not a help request or topic belongs here.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">44,817</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">710,018</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129791050#129807562"><span class="normalTextSmaller"><div>
		<b>09:50 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">dr01d3k4</div></span></a></td>
</tr><tr class="table-header forum-table-header">
	<th class="first" colspan="2"><a id="ctl00_cphRoblox_ForumGroupRepeater1_ctl04_GroupTitle" class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID=6">Entertainment</a></th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th><th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th><th style="width:135px;white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=42"><div class="forumTitle">
		Video Game Fans
	</div><div>
		Talk about your favorite video and computer games  outside of ROBLOX, with other fanatical video gamers!
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">89,611</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">841,891</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129725914#129808828"><span class="normalTextSmaller"><div>
		<b>10:18 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">rockandroll6751</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=38"><div class="forumTitle">
		Forum Games
	</div><div>
		Post your most hilarious forum games here. Who's the best at typing with their elbows? Give gifts to the person above you. Play classic forum games and make up new ones!
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">47,606</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">1,555,839</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=648578#129808427"><span class="normalTextSmaller"><div>
		<b>10:09 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">Kmanthe2nd</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=26"><div class="forumTitle">
		Sports Fans
	</div><div>
		Hang out with other ROBLOX sports fans and talk about sports and competitive activities.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">469,568</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">2,637,966</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129722812#129808859"><span class="normalTextSmaller"><div>
		<b>10:18 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">xxwaffleironxx</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=24"><div class="forumTitle">
		Music Talk
	</div><div>
		Does your Robloxian rock? Let people know. Or just talk about your favorite bands.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">89,834</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">893,637</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129720065#129808785"><span class="normalTextSmaller"><div>
		<b>10:17 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">kurshak</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=25"><div class="forumTitle">
		Movies/TV/Books
	</div><div>
		Does your Robloxian belong on the silver screen, or in the pages of a novel? Show off your ROBLOX movie star, discuss your favorite TV series, films, and the books you love.
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">49,036</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">424,390</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=127119532#129807665"><span class="normalTextSmaller"><div>
		<b>09:52 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">Hydreigons</div></span></a></td>
</tr><tr class="forum-table-row">
	<td colspan="2" style="width:80%;"><a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=23"><div class="forumTitle">
		Role-Playing
	</div><div>
		The forum for story telling and imagination. Start a role-playing thread here involving your fictional characters, or role-play out a scenario with other players. 
	</div></a></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">137,083</span></td><td class="forum-centered-cell" align="center"><span class="normalTextSmaller">7,655,889</span></td><td align="center"><a class="last-post" href="/Forum/ShowPost.aspx?PostID=129597908#129808776"><span class="normalTextSmaller"><div>
		<b>10:17 AM</b>
	</div></span><span class="normalTextSmaller notranslate"><div class="notranslate">kseeking</div></span></a></td>
</tr>
</table>
				<P></P>
			</td>

			<td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>
			
            <!-- right column -->
			<td id="ctl00_cphRoblox_RightColumn" nowrap="nowrap" width="160" class="RightColumn" style="padding-top:88px;">
			    
            <div style="width: 160px">
    <span id='3631363436333936' class="GPTAd skyscraper" data-js-adtype="gptAd">
        <script type="text/javascript">
            googletag.cmd.push(function () {
                googletag.display("3631363436333936");
            });
        </script>
    </span>
    <div class="ad-annotations " style="width: 160px">
        <span class="ad-identification">Advertisement
        </span>
            <a class="BadAdButton" href="/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
    </div>
</div>

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
