<?php
// rewritten by skyler
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Web\SiteAlert;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <!-- MachineID: WEB186 -->
    <title><?= $site_properties['hostname'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="author" content="RBLX.local" />
    <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." />
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    

    
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
    


<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css' />

    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___d2eeb5738db9c7a822adf9b46cf9784f_m.css' />

        
    

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

    <script type='text/javascript' src='https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/4564b16e8c662d0f22e92bfbfe939d9d.js'></script>

    <script type='text/javascript' src='https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/ab68faa5d84854f0a12ec8055bc30286.js'></script>

    <script type='text/javascript'>Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/1612c57544c7977e19cd15c824f7ecc3.js';Roblox.config.paths['Pages.CatalogShared'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/209f2b781ea84e8d0332648ddf547d57.js';Roblox.config.paths['Pages.Messages'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/e8cbac58ab4f0d8d4c707700c9f97630.js';Roblox.config.paths['Resources.Messages'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/bbaeb48f3312bad4626e00c90746ffc0.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/7b436bae917789c0b84f40fdebd25d97.js';Roblox.config.paths['Widgets.GroupImage'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/33d82b98045d49ec5a1f635d14cc7010.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/fbb86cf0752d23f389f983419d3085b4.js';Roblox.config.paths['Widgets.ItemImage'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/8babd891cf420dfe3999b3824a0154cb.js';Roblox.config.paths['Widgets.PlaceImage'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/f2697119678d0851cfaa6c2270a727ed.js';Roblox.config.paths['Widgets.SurveyModal'] = 'https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/d6e979598c460090eafb6d38231159f6.js';</script>
    
        
    <script type='text/javascript' src='https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/c72cdccff7c18a597489b7f3ec469a5d.js'></script>


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
Roblox.Endpoints.Urls['/asset/'] = 'https://www.<?= $site_properties['hostname'] ?>/asset/';
Roblox.Endpoints.Urls['/client-status/set'] = '/client-status/set';
Roblox.Endpoints.Urls['/client-status'] = '/client-status';
Roblox.Endpoints.Urls['/game/'] = 'https://www.<?= $site_properties['hostname'] ?>/game/';
Roblox.Endpoints.Urls['/game/edit.ashx'] = 'https://www.<?= $site_properties['hostname'] ?>/game/edit.ashx';
Roblox.Endpoints.Urls['/game/getauthticket'] = 'https://www.<?= $site_properties['hostname'] ?>/game/getauthticket';
Roblox.Endpoints.Urls['/game/placelauncher.ashx'] = 'https://www.<?= $site_properties['hostname'] ?>/game/placelauncher.ashx';
Roblox.Endpoints.Urls['/game/report-stats'] = 'https://www.<?= $site_properties['hostname'] ?>/game/report-stats';
Roblox.Endpoints.Urls['/game/report-event'] = 'https://www.<?= $site_properties['hostname'] ?>/game/report-event';
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
Roblox.Endpoints.Urls['/asset/request-thumbnail-fix'] = 'https://www.<?= $site_properties['hostname'] ?>/asset/request-thumbnail-fix';
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
Roblox.Endpoints.Urls['/thumbnail/avatar-headshot/'] = '/thumbnail/avatar-headshot/';
Roblox.Endpoints.Urls['/thumbnail/avatar-headshots/'] = '/thumbnail/avatar-headshots/';
Roblox.Endpoints.Urls['/thumbnail/place/'] = '/thumbnail/place/';
Roblox.Endpoints.Urls['/thumbnail/user-avatar/'] = '/thumbnail/user-avatar/';
Roblox.Endpoints.Urls['/thumbnail/asset/'] = '/thumbnail/asset/';
Roblox.Endpoints.Urls['/thumbnail/resolve-hash/'] = '/thumbnail/resolve-hash/';
Roblox.Endpoints.Urls['/thumbnail/get-asset-media'] = '/thumbnail/get-asset-media';
Roblox.Endpoints.Urls['/thumbnail/remove-asset-media'] = '/thumbnail/remove-asset-media';
Roblox.Endpoints.Urls['/thumbnail/set-asset-media-sort-order'] = '/thumbnail/set-asset-media-sort-order';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails'] = '/thumbnail/place-thumbnails';
Roblox.Endpoints.Urls['/thumbnail/place-thumbnails-partial'] = '/thumbnail/place-thumbnails-partial';
Roblox.Endpoints.Urls['/thumbnail_holder/g'] = '/thumbnail_holder/g';
Roblox.Endpoints.Urls['/groups/getprimarygroupinfo.ashx'] = '/groups/getprimarygroupinfo.ashx';
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


<?= SiteHeader::render() ?>
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
                                
		   
<div id="BCPageContainer">
	<div id="UserDataInfo" data-auth="false" data-active-bc="false"></div>
	<div class="header">
		<span><h1>Upgrade to RBLX.local Builders Club</h1></span>
	</div>
	<div class="left-column">
		<table cellspacing="0" border="0">
			<thead class="product-title">
				<tr>
					<td class="center-bold">
						<h2 class="product-space">Free</h2>
						<img data-attribute="free" src="https://s3.amazonaws.com/images.roblox.com/77add140640c3388e6c9603bc5983846.png" alt="free" />
					</td>
					<td class="center-bold">
						<h2 class="product-space">Classic</h2>
                        <img data-attribute="classic" src="https://s3.amazonaws.com/images.roblox.com/ba707f47bb20a1f4804da461fb5d3c31.png" alt=" bc" />
					</td>
					<td class="center-bold">
						<h2 class="product-space">Turbo</h2>
                        <img data-attribute="turbo" src="https://s3.amazonaws.com/images.roblox.com/d7eb3ed186e351d99ce8c11503675721.png" alt="tbc" />
					</td>
					<td class="center-bold">
						<h2 class="product-space">Outrageous</h2>
                        <img data-attribute="outrageous" src="https://s3.amazonaws.com/images.roblox.com/ca1d0aef06c5fc06a2d8b23aea5e20d2.png" alt="obc" />
					</td>
				</tr>
			</thead>
			
	<tbody class="product-summary summary-big">
			<tr>
				<td class="divider-top">
					<span class="product-description">Daily ROBUX</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product ">
					R$15
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					R$35
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        R$60
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Active Places</span>
					<span class="nbc-product">1</span>
				</td>
				<td class="divider-top bc-product ">
					10
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					25
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        100!
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Join Groups</span>
					<span class="nbc-product">5</span>
				</td>
				<td class="divider-top bc-product ">
					10
				</td>
				<td class="divider-top tbc-product ">
					20
				</td>
			    <td class="divider-top obc-product ">
			        100!
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Create Groups</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product ">
					10
				</td>
				<td class="divider-top tbc-product ">
					20
				</td>
			    <td class="divider-top obc-product ">
			        100!
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Signing Bonus*</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product ">
					R$100
				</td>
				<td class="divider-top tbc-product ">
					R$100
				</td>
			    <td class="divider-top obc-product ">
			        R$100
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Paid Access</span>
					<span class="nbc-product">10%</span>
				</td>
				<td class="divider-top bc-product ">
					70%
				</td>
				<td class="divider-top tbc-product ">
					70%
				</td>
			    <td class="divider-top obc-product ">
			        70%
			    </td>
			</tr>
                    <tr>
                <td colspan="4">* Signing bonus is for first time membership purchase only.</td>
				<td colspan="4">Note: This page is only used for shows and not for purchasing BC.</td>
            </tr>
	</tbody>

<tbody class="product-grid">
        <tr>
            
            <td class="product-cell divider-left">
                <div class="product-nbc divider-bottom"></div>
            </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        	<div class="product-text">
		<h3>Monthly</h3>
	</div>

                        <a  data-pid="1" data-rank="BC" data-duration="Monthly" class="btn-medium btn-primary product-button">$5.95</a>
                    </div>
                </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        	<div class="product-text">
		<h3>Monthly</h3>
	</div>

                        <a  data-pid="34" data-rank="TBC" data-duration="Monthly" class="btn-medium btn-primary product-button">$11.95</a>
                    </div>
                </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        	<div class="product-text">
		<h3>Monthly</h3>
	</div>

                        <a  data-pid="28" data-rank="OBC" data-duration="Monthly" class="btn-medium btn-primary product-button">$19.95</a>
                    </div>
                </td>
        </tr>
        <tr>
            
            <td class="product-cell divider-left">
                <div class="product-nbc divider-bottom"></div>
            </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        	<div class="product-text">
		<h3>Annually</h3>
	</div>

                        <a  data-pid="24" data-rank="BC" data-duration="Annually" class="btn-medium btn-primary product-button">$57.95</a>
                    </div>
                </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        	<div class="product-text">
		<h3>Annually</h3>
	</div>

                        <a  data-pid="27" data-rank="TBC" data-duration="Annually" class="btn-medium btn-primary product-button">$85.95</a>
                    </div>
                </td>
                <td class="product-cell divider-left">
                    <div class="product-cell">
                        	<div class="product-text">
		<h3>Annually</h3>
	</div>

                        <a  data-pid="33" data-rank="OBC" data-duration="Annually" class="btn-medium btn-primary product-button">$129.95</a>
                    </div>
                </td>
        </tr>
</tbody>
	<tbody class="product-summary summary-small">
			<tr>
				<td class="divider-top">
					<span class="product-description">Ad Free</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product 		emphasis
">
					✔
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					✔
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        ✔
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Sell Stuff</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product 		emphasis
">
					✔
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					✔
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        ✔
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Virtual Hat</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product 		emphasis
">
					✔
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					✔
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        ✔
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Bonus Gear</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product 		emphasis
">
					✔
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					✔
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        ✔
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">BC Beta Features</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product 		emphasis
">
					✔
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					✔
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        ✔
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Personal Servers</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product 		emphasis
">
					✔
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					✔
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        ✔
			    </td>
			</tr>
			<tr>
				<td class="divider-top">
					<span class="product-description">Trade System</span>
					<span class="nbc-product">No</span>
				</td>
				<td class="divider-top bc-product 		emphasis
">
					✔
				</td>
				<td class="divider-top tbc-product 		emphasis
">
					✔
				</td>
			    <td class="divider-top obc-product 		emphasis
">
			        ✔
			    </td>
			</tr>
        	</tbody>






		</table>
	</div>
	<div class="right-column">

<div id="RightColumnWrapper">
    <div class="cell cellDivider">
        For billing and payment questions: <span class="SL_swap" id="CsEmailLink"><a href="mailto:info@<?= $site_properties['hostname'] ?>">info@<?= $site_properties['hostname'] ?></a></span>
    </div>
    
    <div class="cell cellDivider">
        <h3>Buy ROBUX</h3>
        <p>ROBUX is the virtual currency used in many of our online games. You can also use ROBUX for finding a great look for your character. Get cool gear to take into multiplayer battles. Buy Limited items to sell and trade. You’ll need ROBUX to make it all happen. What are you waiting for?</p>
        <p>
            <a  href="/upgrades/robux?ctx=upgrade" class="btn-medium btn-primary">Buy ROBUX</a>
        </p>
        <h3>Buy ROBUX with</h3><br /><br />
        <a href="/rixtypin"><img src="https://s3.amazonaws.com/images.roblox.com/028e16231452041ab6d702ea467e96dd.png" alt="rixty" /></a><br /><br />
        <a href="http://itunes.apple.com/us/app/roblox-mobile/id431946152?mt=8"><img src="https://s3.amazonaws.com/images.roblox.com/70deff83e869746b0bbc41a86f420844.png" alt="itunes" /></a>
    </div>
        <div class="cell cellDivider">
            <h3>Gift Cards</h3><br />
            <a href="/upgrades/giftcards.aspx" class="giftCardImage"><img src="https://s3.amazonaws.com/images.roblox.com/bf9f4b65f937ad01f07ae6714eaba723.png" alt="giftcard" /></a>
            <div>
                    <div class="giftCardButton">
                        <a  href="/upgrades/giftcards.aspx" class="btn-small btn-primary">Buy Card</a>
                    </div>
                                    <div><a href="/gamecard" class="redeemLink">Redeem card</a></div>
                <div style="clear: both"></div>
            </div>
        </div>
    <div class="cell cellDivider">
        <h3>Game Cards</h3>
        <a href="/gamecards"><img alt="RBLX.local Gamecards" src="https://s3.amazonaws.com/images.roblox.com/863c65342816d665de28411cf47cde42.png" /></a>
        <div class="gameCardControls">
            <div class="gameCardButton">
                <a  href="/gamecards" class="btn-small btn-primary">Where to Buy</a>
            </div>
            <div><a href="/gamecard" class="redeemLink">Redeem Card</a></div>
            <div style="clear: both"></div>
        </div>
    </div>
    <div class="cell">
        <h3>Parents</h3>
        <p>Learn more about Builders Club and how we help <a href="http://corp.<?= $site_properties['hostname'] ?>/parents" class="roblox-interstitial">keep kids safe.</a></p>
        <h3>Cancellation</h3>
        <p>You can turn off membership auto renewal at any time before the renewal date and you will continue to receive Builders Club privileges for the remainder of the currently paid period. To turn off membership auto renewal, please click the 'Cancel Membership Renewal button' on the <a href="/my/account?tab=billing" class="roblox-interstitial">Billing</a> tab of the Settings page and confirm the cancellation.</p>
    </div>
</div>
	</div>
    <div id="dialog-confirmation" style="display: none;"></div>
    <script>
        $(function() {
            if (GoogleAnalyticsEvents) {
                GoogleAnalyticsEvents.SetCustomVar(1, 'BCButtonClick', '', 2);
                GoogleAnalyticsEvents.FireEvent(['RobuxBcClick', 'BCButtonClick', '']);
            }
        });
    </script>
</div>
                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
<?= SiteFooter::render() ?>

</div>                </div>
            </div> 
        </div> 
    </div> 
</div> 




    <script type="text/javascript">function urchinTracker() {}</script>


<div id="PlaceLauncherStatusPanel" style="display:none;width:300px"
     data-new-plugin-events-enabled="True"
     data-event-stream-for-plugin-enabled="True"
     data-event-stream-for-protocol-enabled="True"
     data-is-protocol-handler-launch-enabled="False"
     data-is-user-logged-in="False"
     data-os-name="Unknown"
     data-protocol-name-for-client="roblox-player"
     data-protocol-name-for-studio="roblox-studio"
     data-protocol-url-includes-launchtime="true"
     data-protocol-detection-enabled="true">
    <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
        <div id="Spinner" class="Spinner" style="padding:20px 0;">
            <img src="https://s3.amazonaws.com/images.<?= $site_properties['hostname'] ?>/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
        </div>
        <div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
            <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
                Starting Roblox...
            </div>
            <div id="Waiting" class="PlaceLauncherStatus MadStatusField">Connecting to Players...</div>
            <div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div>
        </div>
        <div style="text-align:center;margin-top:1em">
            <input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel" />
        </div>
    </div>
</div>
<div id="ProtocolHandlerStartingDialog" style="display:none;">
    <div class="modalPopup ph-modal-popup">
        <div class="ph-modal-header">

        </div>
        <div class="ph-logo-row">
            <img src="/images/Logo/logo_meatball.svg" width="90" height="90" alt="R" />
        </div>
        <div class="ph-areyouinstalleddialog-content">
            <p class="larger-font-size">
                ROBLOX is now loading. Get ready to play!
            </p>
            <div class="ph-startingdialog-spinner-row">
                <img src="https://s3.amazonaws.com/images.<?= $site_properties['hostname'] ?>/4bed93c91f909002b1f17f05c0ce13d1.gif" width="82" height="24" />
            </div>
        </div>
    </div>
</div>
<div id="ProtocolHandlerAreYouInstalled" style="display:none;">
    <div class="modalPopup ph-modal-popup">
        <div class="ph-modal-header">
            <span class="rbx-icon-close simplemodal-close"></span>
        </div>
        <div class="ph-logo-row">
            <img src="/images/Logo/logo_meatball.svg" width="90" height="90" alt="R" />
        </div>
        <div class="ph-areyouinstalleddialog-content">
            <p class="larger-font-size">
                You're moments away from getting into the game!
            </p>
            <div>
                <button type="button" class="btn rbx-btn-primary-sm" id="ProtocolHandlerInstallButton">
                    Download and Install ROBLOX
                </button>
            </div>
            <div class="rbx-small rbx-text-notes">
                <a href="https://en.help.<?= $site_properties['hostname'] ?>/hc/en-us/articles/204473560" class="rbx-link" target="_blank">Click here for help</a>
            </div>

        </div>
    </div>
</div>
<div id="ProtocolHandlerClickAlwaysAllowed" class="ph-clickalwaysallowed" style="display:none;">
    <p class="larger-font-size">
        <span class="rbx-icon-moreinfo"></span>
        Check <b>Remember my choice</b> and click <img src="https://s3.amazonaws.com/images.<?= $site_properties['hostname'] ?>/7c8d7a39b4335931221857cca2b5430b.png" alt="Launch Application" />  in the dialog box above to join games faster in the future!
    </p>
</div>


    <div id="videoPrerollPanel" style="display:none">
        <div id="videoPrerollTitleDiv">
            Gameplay sponsored by:
        </div>
        <div id="videoPrerollMainDiv"></div>
        <div id="videoPrerollCompanionAd"></div>
        <div id="videoPrerollLoadingDiv">
            Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
            <div id="videoPrerollLoadingBar">
                <div id="videoPrerollLoadingBarCompleted">
                </div>
            </div>
        </div>
        <div id="videoPrerollJoinBC">
            <span>Get more with Builders Club!</span>
            <a href="/premium/membership?ctx=preroll" target="_blank" class="btn-medium btn-primary" id="videoPrerollJoinBCButton">Join Builders Club</a>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            if (Roblox.VideoPreRoll) {
                Roblox.VideoPreRoll.showVideoPreRoll = false;
                Roblox.VideoPreRoll.isPrerollShownEveryXMinutesEnabled = true;
                Roblox.VideoPreRoll.loadingBarMaxTime = 33000;
                Roblox.VideoPreRoll.videoOptions.key = "robloxcorporation"; 
                    Roblox.VideoPreRoll.videoOptions.categories = "AgeUnknown,GenderUnknown";
                                     Roblox.VideoPreRoll.videoOptions.id = "games";
                Roblox.VideoPreRoll.videoLoadingTimeout = 11000;
                Roblox.VideoPreRoll.videoPlayingTimeout = 41000;
                Roblox.VideoPreRoll.videoLogNote = "NotWindows";
                Roblox.VideoPreRoll.logsEnabled = true;
                Roblox.VideoPreRoll.excludedPlaceIds = "32373412";
                Roblox.VideoPreRoll.adTime = 15;
                    
                Roblox.VideoPreRoll.specificAdOnPlacePageEnabled = true;
                Roblox.VideoPreRoll.specificAdOnPlacePageId = 192800;
                Roblox.VideoPreRoll.specificAdOnPlacePageCategory = "stooges";
                
                                    
                Roblox.VideoPreRoll.specificAdOnPlacePage2Enabled = true;
                Roblox.VideoPreRoll.specificAdOnPlacePage2Id = 2370766;
                Roblox.VideoPreRoll.specificAdOnPlacePage2Category = "lego";
                
                $(Roblox.VideoPreRoll.checkEligibility);
            }
        });
    </script>


<div id="GuestModePrompt_BoyGirl" class="Revised GuestModePromptModal" style="display:none;">
    <div class="simplemodal-close">
        <a class="ImageButton closeBtnCircle_20h" style="cursor: pointer; margin-left:455px;top:7px; position:absolute;"></a>
    </div>
    <div class="Title">
        Choose Your Character
    </div>
    <div style="min-height: 275px; background-color: white;">
        <div style="clear:both; height:25px;"></div>

        <div style="text-align: center;">
            <div class="VisitButtonsGuestCharacter VisitButtonBoyGuest" style="float:left; margin-left:45px;"></div>
            <div class="VisitButtonsGuestCharacter VisitButtonGirlGuest" style="float:right; margin-right:45px;"></div>
        </div>
        <div style="clear:both; height:25px;"></div>
        <div class="RevisedFooter">
            <div style="width:200px;margin:10px auto 0 auto;">
                <a href="/?returnUrl=%2Fpremium%2Fmembership"><div class="RevisedCharacterSelectSignup"></div></a>
                <a class="HaveAccount" href="/newlogin?returnUrl=%2Fpremium%2Fmembership">I have an account</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function checkRobloxInstall() {
                 window.location = '/install/unsupported.aspx'; return false;
    }

</script>

<style>
    #win_firefox_install_img .activation {
    }

    #win_firefox_install_img .installation {
        width: 869px;
        height: 331px;
    }

    #mac_firefox_install_img .activation {
    }

    #mac_firefox_install_img .installation {
        width: 250px;
    }

    #win_chrome_install_img .activation {
    }

    #win_chrome_install_img .installation {
    }

    #mac_chrome_install_img .activation {
        width: 250px;
    }

    #mac_chrome_install_img .installation {
    }
</style>
<div id="InstallationInstructions" class="modalPopup blueAndWhite" style="display:none;overflow:hidden">
    <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
    <div style="padding-bottom:10px;text-align:center">
        <br /><br />
    </div>
</div>



<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>

<script type='text/javascript' src='https://s3.amazonaws.com/js.<?= $site_properties['hostname'] ?>/6077529ce969aded942c2ec9b40c91c0.js'></script>

<script type="text/javascript">
    Roblox.Client._skip = '/install/unsupported.aspx';
    Roblox.Client._CLSID = '';
    Roblox.Client._installHost = '';
    Roblox.Client.ImplementsProxy = false;
    Roblox.Client._silentModeEnabled = false;
    Roblox.Client._bringAppToFrontEnabled = false;
    Roblox.Client._currentPluginVersion = '';
    Roblox.Client._eventStreamLoggingEnabled = false;

        
        Roblox.Client._installSuccess = function() {
            if(GoogleAnalyticsEvents){
                GoogleAnalyticsEvents.ViewVirtual('InstallSuccess');
                GoogleAnalyticsEvents.FireEvent(['Plugin','Install Success']);
                if (Roblox.Client._eventStreamLoggingEnabled && typeof Roblox.GamePlayEvents != "undefined") {
                    Roblox.GamePlayEvents.SendInstallSuccess(Roblox.Client._launchMode, play_placeId);
                }
            }
        }
        
    </script>


<div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
    <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div class="TopBody">
            <div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>
        </div>
        <div class="ConfirmationModalButtonContainer GenericModalButtonContainer">
            <a href id="roblox-confirm-btn"><span></span></a>
            <a href id="roblox-decline-btn"><span></span></a>
        </div>
        <div class="ConfirmationModalFooter">
        
        </div>  
    </div>  
    <script type="text/javascript">
        Roblox = Roblox || {};
        Roblox.Resources = Roblox.Resources || {};
        
        //<sl:translate>
        Roblox.Resources.GenericConfirmation = {
            yes: "Yes",
            No: "No",
            Confirm: "Confirm",
            Cancel: "Cancel"
        };
        //</sl:translate>
    </script>
</div>





    <script type="text/javascript">
        $(function () {
            Roblox.CookieUpgrader.domain = '<?= $site_properties['hostname'] ?>';
            Roblox.CookieUpgrader.upgrade("GuestData", { expires: Roblox.CookieUpgrader.thirtyYearsFromNow });
            Roblox.CookieUpgrader.upgrade("RBXSource", { expires: function (cookie) { return Roblox.CookieUpgrader.getExpirationFromCookieValue("rbx_acquisition_time", cookie); } });
            Roblox.CookieUpgrader.upgrade("RBXViralAcquisition", { expires: function (cookie) { return Roblox.CookieUpgrader.getExpirationFromCookieValue("time", cookie); } });
            
                Roblox.CookieUpgrader.upgrade("RBXMarketing", { expires: Roblox.CookieUpgrader.thirtyYearsFromNow });
            
                        
                Roblox.CookieUpgrader.upgrade("RBXSessionTracker", { expires: Roblox.CookieUpgrader.fourHoursFromNow });
            
        });
    </script>


</body>
</html>
