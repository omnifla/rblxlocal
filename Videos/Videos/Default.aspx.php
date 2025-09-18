<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeaderVideos;
$user = Auth::GetAuthenticatedUserInfo();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <!-- MachineID: WEB186 -->
    <title>RBLX.Videos</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="author" content="RBLX.Videos" />
    <meta name="description" content="Publish your own videos about RBLX.local inside of RBLX.Videos" />
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    

    
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
    


<link rel='stylesheet' href='https://www.aftwld.xyz/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css' />
<link rel='stylesheet' href='https://www.aftwld.xyz/CSS/Base/CSS/FetchCSS?path=page___d2eeb5738db9c7a822adf9b46cf9784f_m.css' />
<link rel="stylesheet" href="https://www.aftwld.xyz/CSS/Base/CSS/FetchCSS?path=page___a3f1c9d8e4726b5d01f4378b29c54e7a_m.css">

        
    

	<script type="text/javascript">

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
        
            _gaq.push(['b._setCustomVar', 1, 'Visitor', 'Anonymous', 2]);
            _gaq.push(['b._trackPageview']);    
        
        
        

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
<div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer)\.watr13\.icu|robloxlabs\.com)((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))" data-regex-flags="gm"></div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.js'><\/script>");
</script>
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-3.5.2.min.js"></script>
<script type="text/javascript">
    window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>");
</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

    <script type='text/javascript' src='https://s3.amazonaws.com/js.www.aftwld.xyz/4564b16e8c662d0f22e92bfbfe939d9d.js'></script>

    <script type='text/javascript' src='https://s3.amazonaws.com/js.www.aftwld.xyz/ab68faa5d84854f0a12ec8055bc30286.js'></script>

    <script type='text/javascript'>Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/1612c57544c7977e19cd15c824f7ecc3.js';Roblox.config.paths['Pages.CatalogShared'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/209f2b781ea84e8d0332648ddf547d57.js';Roblox.config.paths['Pages.Messages'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/e8cbac58ab4f0d8d4c707700c9f97630.js';Roblox.config.paths['Resources.Messages'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/bbaeb48f3312bad4626e00c90746ffc0.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/7b436bae917789c0b84f40fdebd25d97.js';Roblox.config.paths['Widgets.GroupImage'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/33d82b98045d49ec5a1f635d14cc7010.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/fbb86cf0752d23f389f983419d3085b4.js';Roblox.config.paths['Widgets.ItemImage'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/8babd891cf420dfe3999b3824a0154cb.js';Roblox.config.paths['Widgets.PlaceImage'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/f2697119678d0851cfaa6c2270a727ed.js';Roblox.config.paths['Widgets.SurveyModal'] = 'https://s3.amazonaws.com/js.www.aftwld.xyz/d6e979598c460090eafb6d38231159f6.js';</script>
    
        
    <script type='text/javascript' src='https://s3.amazonaws.com/js.www.aftwld.xyz/c72cdccff7c18a597489b7f3ec469a5d.js'></script>


<script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script>

<script type="text/javascript">
    var Roblox = Roblox || {};
    Roblox.UpsellAdModal = Roblox.UpsellAdModal || {};

    Roblox.UpsellAdModal.Resources = {
        //<sl:translate>
        title: "Remove Ads Like This",
        body: "Builders Club members do not see external ads like these.",
        accept: "Upgrade Now",
        decline: "No, thanks"
        //</sl:translate>
    };
</script>
        <script type="text/javascript">
            Roblox.XsrfToken.setToken('k8a6rShpGUQj');
        </script>
        <script type="text/javascript">
        Roblox.FixedUI.gutterAdsEnabled = false;
    </script>
    

    <script type="text/javascript">
        var Roblox = Roblox || {};
        Roblox.jsConsoleEnabled = false;
    </script>
    
    <script>
        $(function () {
            Roblox.DeveloperConsoleWarning.showWarning();
        });
    </script>
            <script type="text/javascript">
            $(function() {
                if (Roblox.EventStream) {
                    Roblox.EventStream.InitializeEventStream("//ecsv2.<?= $site_properties['hostname'] ?>/www/e.png");
                }
            });
        </script>
    <script type="text/javascript">
if (typeof(Roblox) === "undefined") { Roblox = {}; }
Roblox.Endpoints = Roblox.Endpoints || {};
Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
</script>

</head>
<body class="">
    




<div id="fb-root"></div>

<div class="nav-container no-gutter-ads">
<?= SiteHeaderVideos::render() ?>
<div id="navContent" class="nav-content  ">
        <div class="nav-content-inner">
            <div id="MasterContainer">
                    <script type="text/javascript">
                        if (top.location != self.location) {
                            top.location = self.location.href;
                        }
                    </script>
                

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


                <div>
                                                            <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
                    <div id="BodyWrapper" class="">
                        <div id="RepositionBody">
                            <div id="Body" style="width:970px">
				<h1>Videos</h1>		
        <div class="video-list-card">
            <div class="video-thumb">
                <img alt="Video Thumbnail" src="https://placehold.co/280x158" />
                <span class="video-duration">N/A Not finished lol</span>
            </div>
            <div class="video-info">
                <a href="/videos/watch.aspx?id=0" class="video-title">
                    not finished
                </a>
                <div class="video-meta">
                    0 views • Uploaded at NaN
                </div>
                <div class="video-channel">
                    <img class="channel-avatar" src="https://www.<?= $site_properties['hostname'] ?>/Thumbs/Avatar.ashx?userId=1&amp;x=200&amp;y=200" alt="User Avatar" />
                    <span class="channel-name">
                        <a href="/Videos/User.aspx?id=1">
                            <strong>OnlyTwentyCharacters</strong>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    <p>No videos uploaded yet.</p>
<div>
                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
