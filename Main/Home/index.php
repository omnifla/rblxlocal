<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
// e
// redirects the user to /newlogin?redirect-url=url if not logged in (used to show 401 error before)
if(!Auth::GetAuthenticatedUser()){
    $url = $_SERVER['REQUEST_URI'];
    $redirect = '/newlogin?redirect-url=' . urlencode($url);
    header('Location: ' . $redirect);
    exit;
}

$user = Auth::GetAuthenticatedUserInfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- MachineID: WEB1 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">
    
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="author" content="ROBLOX Corporation">
    <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine.">
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine">
    
    

    <title><?= $site_properties['hostname'] ?></title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="http://<?= $site_properties['hostname'] ?>/favicon.ico">
    
    
<link rel="stylesheet" href="https://<?= $site_properties['hostname'] ?>/CSS/Base/CSS/FetchCSS?path=main___9f842fd9a1a7173bd52d5de5563566b8_m.css">

    
<link rel="stylesheet" href="https://<?= $site_properties['hostname'] ?>/CSS/Base/CSS/FetchCSS?path=page___bd540dc4bbc3cb88bfd00f03ec91d022_m.css">

    
	<script async="" type="text/javascript" src="./<?= $site_properties['hostname'] ?>_files/gpt.js"></script><script type="text/javascript" src="https://js.rbxcdn.com/9db05af88b1dc737664247f24a0120e0.js.gzip"></script><link href="./<?= $site_properties['hostname'] ?>_files/BestFriends.css" rel="stylesheet" type="text/css"><script type="text/javascript" src="https://js.rbxcdn.com/e96b59fba745a37cdd847ff394b79aac.js.gzip"></script><script type="text/javascript" src="https://js.rbxcdn.com/9f4404fc11d8b8958d09f6316719cef9.js.gzip"></script><script type="text/javascript" async="" src="./<?= $site_properties['hostname'] ?>_files/ga.js"></script><script type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-11419793-1']);
		_gaq.push(['_setCampSourceKey', 'rbx_source']);
		_gaq.push(['_setCampMediumKey', 'rbx_medium']);
		_gaq.push(['_setCampContentKey', 'rbx_campaign']);
		_gaq.push(['_setDomainName', '<?= $site_properties['hostname'] ?>']);

		_gaq.push(['b._setAccount', 'UA-486632-1']);
		_gaq.push(['b._setCampSourceKey', 'rbx_source']);
		_gaq.push(['b._setCampMediumKey', 'rbx_medium']);
		_gaq.push(['b._setCampContentKey', 'rbx_campaign']);
		_gaq.push(['b._setDomainName', '<?= $site_properties['hostname'] ?>']);
		_gaq.push(['c._setAccount', 'UA-26810151-2']);
		_gaq.push(['c._setDomainName', '<?= $site_properties['hostname'] ?>']);

		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();

	</script>
    <script type="text/javascript" src="./<?= $site_properties['hostname'] ?>_files/jquery-1.7.2.min.js"></script>
<script type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='https://<?= $site_properties['hostname'] ?>/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
<script type="text/javascript" src="./<?= $site_properties['hostname'] ?>_files/MicrosoftAjax.js"></script>
<script type="text/javascript">window.Sys || document.write("<script type='text/javascript' src='https://<?= $site_properties['hostname'] ?>/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

    
<script type="text/javascript" src="https://js.rbxcdn.com/c57cc32d0db0d462c64bb8ace02fdf13.js.gzip"></script>

    <script type="text/javascript">Roblox.config.externalResources = ['https://<?= $site_properties['hostname'] ?>/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = 'http://js.rbxcdn.com/e96b59fba745a37cdd847ff394b79aac.js.gzip';Roblox.config.paths['Pagelets.BestFriends'] = 'http://js.rbxcdn.com/9db05af88b1dc737664247f24a0120e0.js.gzip';Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/10a6b22225379eaa8d41dd1c0ffb6dc3.js.gzip';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/f266eeedec9548a94baf73ccb09e4a5d.js.gzip';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/6307f9bd9c09fa9d88c76291f3b68fda.js.gzip';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/9f4404fc11d8b8958d09f6316719cef9.js.gzip';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/88a3e1afed9aa3b21670a59ddb7775c3.js.gzip';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/c98baf27bc7feda3206342566db92696.js.gzip';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/3f95857727df4739b29a8385501752fa.js.gzip';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/152201bc9a4e721fe8c326c78b35e364.js.gzip';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/4426a131abb3e214ed89338154f6e78a.js.gzip';Roblox.config.paths['Widgets.Suggestions'] = 'http://js.rbxcdn.com/63f96a694a0eedd389b573a5859b8974.js.gzip';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/56ad7af86ee4f8bc82af94269ed50148.js.gzip';</script>
    
<script type="text/javascript" src="https://js.rbxcdn.com/f6ebdcdab40c43bb18d29009ce0880be.js.gzip"></script>

    
<script type="text/javascript" src="https://js.rbxcdn.com/32159205207304027c7e0aa4dd329d32.js.gzip"></script>

    <script type="text/javascript">   
        googletag.cmd.push(function() {
            Roblox = Roblox || {};
            Roblox.AdsHelper = Roblox.AdsHelper || {};
            Roblox.AdsHelper.slots = [];
	        Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_MyHome_Right_160x600", [160, 600], "3439303639313930").addService(googletag.pubads()), id: "3439303639313930"});
 
            for (var key in Roblox.AdsHelper.slots) {
                var slot = Roblox.AdsHelper.slots[key].slot;
                var id = Roblox.AdsHelper.slots[key].id;
                if (slot.renderEnded != "undefined") {
                    (function(slot, id)
                    {
                        slot.renderEndedOld = slot.renderEnded;
                        slot.renderEnded = function() {
                            slot.renderEndedOld();
                            if ($('#' + id + '.gutter').css('display') == "none") {
                                $(document).trigger("GuttersHidden");
                            }
                        };    
                    }(slot, id));
                }
            }

        googletag.pubads().setTargeting("Age", ["13", "13to14" ]);	
            googletag.pubads().setTargeting("Env",  "Production");
        googletag.pubads().enableSingleRequest();
        googletag.pubads().collapseEmptyDivs();
        googletag.enableServices();
	    });
    </script>  
<script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({'internalEventListenerPixelEnabled': true});
    });
</script>        <script type="text/javascript">
            Roblox.XsrfToken.setToken('y5zY3quEFHjD');
        </script>
    <script type="text/javascript">
        Roblox.FixedUI.gutterAdsEnabled = false;
    </script>   
    
<script async="" type="text/javascript" src="./<?= $site_properties['hostname'] ?>_files/pubads_impl_30.js"></script><script type="text/javascript" src="./<?= $site_properties['hostname'] ?>_files/osd.js"></script></head>
<body>
    
<div id="fb-root"></div>
<div id="MasterContainer">
           


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

    
        RobloxListener.restUrl = window.location.protocol + "//" + "<?= $site_properties['hostname'] ?>/Game/EventTracker.ashx";
        RobloxListener.init();
    
    
        GoogleListener.init(); 
    
    
    
    
        RobloxEventManager.initialize(true);
        RobloxEventManager.triggerEvent('rbx_evt_pageview');
        trackReturns(); // trapz was here mewmewomeowmeow
    
    
    
        RobloxEventManager._idleInterval = 450000;
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_ftp');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_fmp');
        RobloxEventManager.startMonitor();
    

});

</script>

    <div>

                                                            
<?= SiteHeader::render() ?>
<div class="forceSpaceUnderSubmenu">&nbsp;</div> 
            <div class="forceSpace">&nbsp;</div>
        <noscript>&lt;div class="SystemAlert"&gt;&lt;div class="SystemAlertText"&gt;Please enable Javascript to use all the features on this site.&lt;/div&gt;&lt;/div&gt;</noscript>
        <div id="BodyWrapper">
            <div id="RepositionBody">
                <div id="Body" style="width:970px">
                    		   
<div id="HomeContainer" class="home-container" data-facebook-share="/facebook/share-character" data-update-status-url="/home/updatestatus" data-get-feed-url="https://<?= $site_properties['hostname'] ?>/feeds/getuserfeed">
	<div>
		<h1>Hello, <span class="notranslate"><?= htmlspecialchars($user['username']) ?></span>!</h1>
	</div>
	<div class="left-column">
	    <div class="left-column-boxes user-avatar-container">
<div id="UserAvatar" class="user-avatar-holder">
    <span class="user-avatar"><img alt="<?= htmlspecialchars($user['username']) ?>" class="user-avatar-image" src="/Images/Placeholder1024x1024.png"></span>
</div>
<div id="UserInfo" class="text">
	<div>
		<b><a class="text-link" href="http://<?= $site_properties['hostname'] ?>/my/messages?111">0 System Notification(s)</a></b>
	</div>
</div>	    </div>
		<div class="left-column-boxes">
			<h3>RBLX.local News</h3>
			<div class="notranslate text news-container">
				<div id="RobloxNews">
    <div class="roblox-news-feed">
                <div class="roblox-news-feed-item">
                    <a href="http://blog.<?= $site_properties['hostname'] ?>/2013/11/racetothebottom-races-to-the-top-with-space-knights/?utm_source=rss&utm_medium=rss&utm_campaign=racetothebottom-races-to-the-top-with-space-knights" ref="news-article" class="roblox-interstitial">RaceToTheBottom Races to the Top with Space Knights</a>
                </div>
                <div class="roblox-news-feed-item">
                    <a href="http://blog.<?= $site_properties['hostname'] ?>/2013/11/developers-share-their-devex-success-stories/?utm_source=rss&utm_medium=rss&utm_campaign=developers-share-their-devex-success-stories" ref="news-article" class="roblox-interstitial">Developers Share Their DevEx Success Stories</a>
                </div>
    </div>
    <a href="http://blog.<?= $site_properties['hostname'] ?>/" class="SeeMore roblox-interstitial">See More</a>
    <img alt="See more! " src="./<?= $site_properties['hostname'] ?>_files/efe86a4cae90d4c37a5d73480dea4cb1.png" class="see-more-img">
</div>
			</div>
		</div>
	    <div class="left-column-boxes">
	        <div>
	            <h3 class="best-friends-title">My Best Friends</h3>
	            <div class="edit-friends-button">
	                <a href="http://<?= $site_properties['hostname'] ?>/my/EditFriends.aspx" class="btn-small btn-neutral">Edit</a>
	            </div>
	            <div class="clear"></div>
	        </div>
	        <div id="bestFriendsContainer" class="best-friends-container">
<div class="best-friends">
    <div class="user">
        <div class="roblox-avatar-image" data-user-id="6570505" data-image-size="tiny">
            <div style="position: relative;">
                <a href="http://<?= $site_properties['hostname'] ?>/user.aspx?id=6570505">
                    <img title="Rootless" alt="Rootless" border="0" src="/Images/Placeholder1024x1024.png">
                </a>
            </div>
        </div>
        <div class="info">
            <img src="/Images/Placeholder1024x1024.png" title="Offline">
            <a class="name" href="http://<?= $site_properties['hostname'] ?>/User.aspx?ID=1">ROBLOX</a>
            <div class="status">"Still in the works"</div>
        </div>
        <div class="clear"></div>
    </div>
</div>

	        <div style="clear:both;"></div>
	    </div>
            <div class="left-column-boxes text">
                	
	<div id="fbNotLoggedIn">
			<img border="0" alt="Facebook Connect" src="//images.rbxcdn.com/4ec0c6c40a454f2f6537946d00f09b56.png">
			<div style="text-align: left; margin: 5px">
				Link your ROBLOX account with your Facebook account to let your Facebook friends see what you're doing on RBLX.local !<br>
			</div>
		<a class="facebook-login" href="http://<?= $site_properties['hostname'] ?>/facebook/authorize?ReturnTo=%2Fmy%2Fhome.aspx">
			<span class="left"></span>
			<span class="middle">Connect with Facebook<span>Connect with Facebook</span></span>
			<span class="right"></span>
		</a>
	</div>

            </div>
	</div>
</div>
	<div class="middle-column">
		<div id="statusUpdateBox" class="middle-column-box status-update">
		    <div>
                    <input name="txtStatusMessage" type="text" id="txtStatusMessage" maxlength="254" class="translate text-box text-box-large status-textbox" placeholder="What are you up to?">
<span class="btn-control btn-control-large share-button" id="shareButton">Share</span>		        
		        <img id="loadingImage" class="status-update-image" style="display: none" alt="Sharing..." src="//images.rbxcdn.com/ec4e85b0c4396cf753a06fade0a8d8af.gif">
		        <div class="clear"></div>
		    </div>
		</div>

        <div id="FeedificationsContainer" class="">

</div>

		<div id="FeedContainer" class="middle-column-box feed-container">
			<h2>My Feed</h2>
			<div id="FeedPanel">
				<div id="AjaxFeed" class="text"><div class="text">
</div>
</div>
				<div id="AjaxFeedError" style="display: none" class="error-message">An error occurred while fetching your feed.</div>
			</div>
		</div>
	</div>

    <div class="right-column">
            <div id="RecentlyVisitedPlacesContainer" class="right-column-box">
                <h3 style="padding-bottom: 6px;">Recently Played Games</h3>
                
<div id="RecentlyVisitedPlaces">
	<div id="RecentlyVisitedPlaceTemplate" class="recent-place-container">
		<div class="recent-place-thumb"></div>
		<div class="recent-place-Info">
			<div class="recent-place-name"></div>
			<div class="recent-place-players-online text"></div>
		</div>
	</div>
</div>
<div id="SeeMore">
        <a href="http://<?= $site_properties['hostname'] ?>/games?sortFilter=6" class="text-link">See More  <img alt="See more! " src="//images.rbxcdn.com/efe86a4cae90d4c37a5d73480dea4cb1.png" class="see-more-img"></a>
</div>
<div id="PlayGames" style="display: none">
	You haven't played any games recently.
	<a href="http://<?= $site_properties['hostname'] ?>/Games.aspx" class="text-link">Play Now  <img alt="See more! " src="//images.rbxcdn.com/efe86a4cae90d4c37a5d73480dea4cb1.png" class="see-more-img"></a>
</div>
            </div>
        <div id="Skyscraper-Ad" class="right-column-box">
<div style="width: 160px">
    <span id="3439303639313930" class="GPTAd skyscraper" data-js-adtype="gptAd">
        <script type="text/javascript">
            googletag.cmd.push(function () {
                googletag.display("3439303639313930");
            });
        </script>
    <div id="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0__container__" style="border: 0pt none;"><iframe id="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0" name="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0" width="160" height="600" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" src="javascript:"<html><body style='background:transparent'></body></html>"" style="border: 0px; vertical-align: bottom;"></iframe></div><iframe id="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0__hidden__" name="google_ads_iframe_/1015347/Roblox_MyHome_Right_160x600_0__hidden__" width="0" height="0" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" src="javascript:"<html><body style='background:transparent'></body></html>"" style="border: 0px; vertical-align: bottom; visibility: hidden; display: none;"></iframe></span>
    <div class="ad-annotations " style="width: 160px">
        <span class="ad-identification">Advertisement</span>
            <a class="BadAdButton" href="http://<?= $site_properties['hostname'] ?>/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
    </div>
</div>        </div>
    </div>
	<div class="clear"></div>
	<div id="UserScreenContainer">

	</div>
</div>


                    <div style="clear:both"></div>
                </div>
            </div>
        </div>

<?= SiteFooter::render() ?>
