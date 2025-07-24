<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<!-- MachineID: WEB79 -->
<head id="ctl00_Head1"><meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" /><title>
	<?= $site_properties['Title'] ?> - Badges
</title>
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___b0b25e7acac88d8be05fac0ac517d974_m.css' />

<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___c4568c130ea428272dbc90c280f1af29_m.css' />
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta http-equiv="Content-Language" content="en-us" /><meta name="author" content="ROBLOX Corporation" /><meta id="ctl00_metadescription" name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." /><meta id="ctl00_metakeywords" name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />	<script type="text/javascript">

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
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

<script type='text/javascript' src='http://js.rbxcdn.com/386b5e5cbf5c1faf27a6b5dd55e889ed.js'></script>
<script type='text/javascript'>Roblox.config.externalResources = ['/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = 'http://js.rbxcdn.com/29cf397a226a92ca602cb139e9aae7d7.js';Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/7123e398c0433de33356ac718bab90d5.js';Roblox.config.paths['Pages.CatalogShared'] = 'http://js.rbxcdn.com/4eb48eec34ca711d5a7b08a4291ac753.js';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/9b1b88b531c486003bbf39ae61963c27.js';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/a404577733d1b68e3056a8cd3f31614c.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/ff651da6797160efb3ebbb2c2f98fb86.js';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/3e692c7b60e1e28ce639184f793fdda9.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/e8b579b8e31f8e7722a5d10900191fe7.js';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/f676cf25d820c731b5adb4bf362bcd90.js';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/08e1942c5b0ef78773b03f02bffec494.js';Roblox.config.paths['Widgets.Suggestions'] = 'http://js.rbxcdn.com/a63d457706dfbc230cf66a9674a1ca8b.js';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script><script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true, 'internalEventListenerPixelEnabled': true});
    });
</script>
<script type='text/javascript' src='http://js.rbxcdn.com/0c66ac0d28c87923e08876fae2518a92.js'></script>
    <script type="text/javascript">
function Roblox_Item_Top_728x90_RTP(estimate){rtp['/1015347/Roblox_Item_Top_728x90'] = rp_valuation.estimate;}
var rtp = rtp || {};
oz_api="valuation";oz_site="9874/18868";oz_zone="58960";oz_ad_slot_size="728x90";oz_callback=Roblox_Item_Top_728x90_RTP;
</script><script type="text/javascript" src="http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script><script>

        googletag.cmd.push(function() {
            Roblox = Roblox || {};
            Roblox.AdsHelper = Roblox.AdsHelper || {};
            Roblox.AdsHelper.slots = [];
            Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Item_Top_728x90", [728, 90], "3435363037303732").addService(googletag.pubads()), id: "3435363037303732", path: "/1015347/Roblox_Item_Top_728x90"});
 
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
<form name="aspnetForm" method="post" action="/Badges.aspx" id="aspnetForm">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTQ2MjgzMTMxOQ9kFgJmD2QWAgIBEBYCHgZhY3Rpb24FDC9CYWRnZXMuYXNweGQWAgIHDw8WAh4HVmlzaWJsZWhkZBgEBSNjdGwwMCRyYnhHb29nbGVBbmFseXRpY3MkTXVsdGlWaWV3MQ8PZGZkBS9jdGwwMCRjcGhCYW5uZXJBZCRJdGVtQmFubmVyQWQkQXN5bmNBZE11bHRpVmlldw8PZAIDZAUkY3RsMDAkUmlnaHRHdXR0ZXJBZCRBc3luY0FkTXVsdGlWaWV3Dw9kAgNkBSNjdGwwMCRMZWZ0R3V0dGVyQWQkQXN5bmNBZE11bHRpVmlldw8PZAIDZOaSvNE8g3vdu1W2FH+FWgLGcpQB" />
</div>


<script src="/ScriptResource.axd?d=OtJ6Pk-iMqPL9D1EePe5pNAW9zwCYx5IKz21xyL4f66HTDWgstWUso4bxnUszulDIRiuZWBkns3WdYmcE8pc4vEg_5FgA7W0efCDRxBSl0Y2JoAEZI2n_xOJnGDQzPUv4E2HchING4S8yTHNlpJWEMPZzB04hae03nVeuHUBZ-OWOdWASx8QdQBwVWxoyCg-8Ftvjsq7s4K_p3ND5gUNxHh0QgU4vCz26SxS_lbYM_tXtE-kMB_WyroRcYjy1DRe-UY1lwZWqIGdXMx3t2MmzEfy_fYnBNO8fcGefSBvDoUr8xYY86ai1L6voznkKmPU7bTCiIuRiJgd6vuhK5LkT9w7t37RK0rspuN3nM-T9uASqaAHM94OdG1al1nbzfL_fWVneRHsoHap_96zlcYGfEMKq7JctSphdbW0SQK0PtUCmlEChUIAdL1-76W3ouzHN6a-NA2" type="text/javascript"></script>
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
        if (!localStorage) return; 

	    var cookieName = 'RBXReturn';
	    var cookieOptions = {expires:9001};
        var cookie = localStorage.getItem(cookieName) || {};

	    if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
	        localStorage.setItem(cookieName, { ts: new Date().toDateString() });
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
	
	    localStorage.setItem(cookieName, cookie);
    }

    
        RobloxListener.restUrl = window.location.protocol + "//" + "<?= $site_properties['hostname'] ?>/Game/EventTracker.ashx";
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
    <div id="AdvertisingLeaderboard">
        
            <div style="width: 728px">
    <span id='3435363037303732' class="GPTAd banner" data-js-adtype="gptAd">
        <script type="text/javascript">
            googletag.cmd.push(function () {
                googletag.display("3435363037303732");
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
                <div id="Body" style=''>
                    
    <div id="BadgesContainer" class="text">
    <h1>Badges</h1>
        <div class="BadgeCategory">
            <h2 >Community Badges</h2>
            <ul>
                    <li id="Badge1" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/ae42d1c6cd258306303423a69b1ed7bf.png" alt="Administrator" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Administrator Badge</h3>
                                <p class="notranslate">This badge identifies an account as belonging to a Roblox administrator. Only official Roblox administrators will possess this badge. If someone claims to be an admin, but does not have this badge, they are potentially trying to mislead you. If this happens, please report abuse and we will delete the imposter&#39;s account.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge12" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/088451f70609387491bbf8e85f285065.png" alt="Veteran" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Veteran Badge</h3>
                                <p class="notranslate">This decoration is awarded to all citizens who have played ROBLOX for at least a year. It recognizes stalwart community members who have stuck with us over countless releases and have helped shape ROBLOX into the game that it is today. These medalists are the true steel, the core of the Robloxian history ... and its future.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge9" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/df659818025cdf3422da7e04475656ac.png" alt="Forum Moderator" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Forum Moderator Badge</h3>
                                <p class="notranslate">Users with this badge are forum moderators. They have special powers on the ROBLOX forum and are able to delete threads that violate the Community Guidelines. Users who are exemplary citizens on ROBLOX over a long period of time may be invited to be moderators. This badge is granted by invitation only.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge10" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/ca460efad9ffdbce1f982672d0bf5e2a.png" alt="Image Moderator" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Image Moderator Badge</h3>
                                <p class="notranslate">Users with this badge are image moderators. Image moderators have special powers on ROBLOX that allow them to approve or disapprove images that other users upload. Rejected images are immediately banished from the site. Users who are exemplary citizens on ROBLOX over a long period of time may be invited to be moderators. This badge is granted by invitation only.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
            </ul>
        </div>
        <div class="BadgeCategory">
            <h2 >Builders Club Badges</h2>
            <ul>
                    <li id="Badge11" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/049d72ade1586da1cfe2e48618cc3959.png" alt="Builders Club" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Builders Club Badge</h3>
                                <p class="notranslate">Members of the illustrious Builders Club display this badge proudly. The Builders Club is a paid premium service. Members receive several benefits: they get ten places on their account instead of one, they earn a daily income of 15 ROBUX, they can sell their creations to others in the ROBLOX Catalog, they get the ability to browse the web site without external ads, and they receive the exclusive Builders Club construction hat.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge15" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/709c584f36286157c955ffcbb8dbfe36.png" alt="Turbo Builders Club" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Turbo Builders Club Badge</h3>
                                <p class="notranslate">Members of the exclusive Turbo Builders Club are some of the most dedicated ROBLOXians. The Turbo Builders Club is a paid premium service. Members receive many of the benefits received in the regular Builders Club, in addition to a few more exclusive upgrades: they get twenty-five places on their account instead of ten from regular Builders Club, they earn a daily income of 35 ROBUX, they can sell their creations to others in the ROBLOX Catalog, they get the ability to browse the web site without external ads, they receive the exclusive Turbo Builders Club red site managers hat, and they receive an exclusive gear item.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge16" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/50e4f48e4007754b55c82fc3d50c9c12.png" alt="Outrageous Builders Club" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Outrageous Builders Club Badge</h3>
                                <p class="notranslate">Members of Outrageous Builders Club are VIP ROBLOXians. They are the cream of the crop. The Outrageous Builders Club is a paid premium service. Members receive 100 places, 100 groups, 60 ROBUX per day, unlock the Outrageous website theme, get access to the CEO and devs of ROBLOX through Outrageous-cast, and many other benefits.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
            </ul>
        </div>
        <div class="BadgeCategory">
            <h2 >Builder Badges</h2>
            <ul>
                    <li id="Badge6" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/26bdc9274d6c2520b3d72ebaa71e50f7.png" alt="Homestead" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Homestead Badge</h3>
                                <p class="notranslate">The homestead badge is earned by having your personal place visited 100 times. Players who achieve this have demonstrated their ability to build cool things that other Robloxians were interested enough in to check out. Get a jump-start on earning this reward by inviting people to come visit your place.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge7" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/4e483c695695b47c92591825929d1059.png" alt="Bricksmith" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Bricksmith Badge</h3>
                                <p class="notranslate">The Bricksmith badge is earned by having a popular personal place. Once your place has been visited 1000 times, you will receive this award. Robloxians with Bricksmith badges are accomplished builders who were able to create a place that people wanted to explore a thousand times. They no doubt know a thing or two about putting bricks together.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
            </ul>
        </div>
        <div class="BadgeCategory">
            <h2 >Friendship Badges</h2>
            <ul>
                    <li id="Badge2" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/46c15f2030a8c68ab1ff4329765e515a.png" alt="Friendship" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Friendship Badge</h3>
                                <p class="notranslate">This badge is given to players who have embraced the Roblox community and have made at least 20 friends. People who have this badge are good people to know and can probably help you out if you are having trouble.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge8" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/156b077267b7848d38df4471e2a2c540.png" alt="Inviter" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Inviter Badge</h3>
                                <p class="notranslate">Robloxia is a vast uncharted realm, as large as the imagination. Individuals who invite others to join in the effort of mapping this mysterious region are honored in Robloxian society. Citizens who successfully recruit three or more fellow explorers via the Share Roblox with a Friend mechanism are awarded with this badge.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
            </ul>
        </div>
        <div class="BadgeCategory">
            <h2 >Combat Badges</h2>
            <ul>
                    <li id="Badge3" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/d111059fca163b9824716cff2fe4aec5.png" alt="Combat Initiation" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Combat Initiation Badge</h3>
                                <p class="notranslate">This badge is given to any player who has proven his or her combat abilities by accumulating 10 victories in battle. Players who have this badge are not complete newbies and probably know how to handle their weapons.</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge4" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/14652f1598ba5520515965b4038214c0.png" alt="Warrior" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Warrior Badge</h3>
                                <p class="notranslate">This badge is given to the warriors of Robloxia, who have time and time again overwhelmed their foes in battle. To earn this badge, you must rack up 100 knockouts. Anyone with this badge knows what to do in a fight!</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
                    <li id="Badge5" class="divider-bottom">
                        <div class="BadgePadding">&nbsp;</div>
                        <div class="BadgeContent">
                            <div class="BadgeImage">
                                <img src="http://images.rbxcdn.com/4cb4d69560f1f3478c314b24a52d2644.png" alt="Bloxxer" width="75" height="75" />
                            </div>
                            <div class="BadgeDescription">
                                <h3>Bloxxer Badge</h3>
                                <p class="notranslate">Anyone who has earned this badge is a very dangerous player indeed. Those Robloxians who excel at combat can one day hope to achieve this honor, the Bloxxer Badge. It is given to the warrior who has bloxxed at least 250 enemies and who has tasted victory more times than he or she has suffered defeat. Salute!</p>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </li>
            </ul>
        </div>
</div>

<script type="text/javascript">
    $(function () {
        // Has a hash, highlight that element
        if (window.location.hash.length != 0) {
            var highlight = $(window.location.hash + ' .BadgeContent');
            highlight.addClass('selectedInitial');
            setTimeout(function() {
                highlight.addClass("selectedFadeOut");
            }, 0);
        }
    });
</script>

                    <div style="clear:both"></div>
                </div>
            </div>
        </div> 
        </div>
        
            <div id="Footer" class="footer-container">
    <div class="FooterNav">
        <a href="/info/Privacy.aspx">Privacy Policy</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.<?= $site_properties['hostname'] ?>/advertise-on-roblox" class="roblox-interstitial">Advertise with Us</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.<?= $site_properties['hostname'] ?>/roblox-press" class="roblox-interstitial">Press</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.<?= $site_properties['hostname'] ?>/contact-us" class="roblox-interstitial">Contact Us</a>
        &nbsp;|&nbsp;
        <a href="http://corp.<?= $site_properties['hostname'] ?>/" class="roblox-interstitial">About Us</a>
        &nbsp;|&nbsp;
        <a href="http://blog.<?= $site_properties['hostname'] ?>" class="roblox-interstitial">Blog</a>
        &nbsp;|&nbsp;
        <a href="http://corp.<?= $site_properties['hostname'] ?>/jobs" class="roblox-interstitial">Jobs</a>
        &nbsp;|&nbsp;
        <a href="http://corp.<?= $site_properties['hostname'] ?>/parents" class="roblox-interstitial">Parents</a>
            <span class="LanguageOptionElement">&nbsp;|&nbsp;</span>
            <span ref="footer-parents" class="LanguageOptionElement LanguageTrigger roblox-interstitial" drop-down-nav-button="LanguageTrigger">English&nbsp;<span class="FooterArrow">▼</span>
                <div class="dropuplanguagecontainer" style="display:none;" drop-down-nav-container="LanguageTrigger">
                    <div class="dropdownmainnav" style="z-index:1023">
                            <a href="/UserLanguage/LanguageRedirect?languageCode=de&amp;relativePath=%2fBadges.aspx"class="LanguageOption js-lang" data-js-langcode="de"><span class="notranslate">Deutsch</span>&nbsp;(German) </a>
                    </div>
                </div>
            </span>
    </div>
    <div class="FooterNav">
        <div id="SEOGenreLinks" class="SEOGenreLinks">
                  <a href="/all-games">All Games</a> 
                      <span>|</span>
                  <a href="/building-games">Building</a> 
                      <span>|</span>
                  <a href="/horror-games">Horror</a> 
                      <span>|</span>
                  <a href="/town-and-city-games">Town and City</a> 
                      <span>|</span>
                  <a href="/military-games">Military</a> 
                      <span>|</span>
                  <a href="/comedy-games">Comedy</a> 
                      <span>|</span>
                  <a href="/medieval-games">Medieval</a> 
                      <span>|</span>
                  <a href="/adventure-games">Adventure</a> 
                      <span>|</span>
                  <a href="/sci-fi-games">Sci-Fi</a> 
                      <span>|</span>
                  <a href="/naval-games">Naval</a> 
                      <span>|</span>
                  <a href="/fps-games">FPS</a> 
                      <span>|</span>
                  <a href="/rpg-games">RPG</a> 
                      <span>|</span>
                  <a href="/sports-games">Sports</a> 
                      <span>|</span>
                  <a href="/fighting-games">Fighting</a> 
                      <span>|</span>
                  <a href="/western-games">Western</a> 
        </div>
    </div>
    <div class="legal">
        <div class="left">
            <div id="a15b1695-1a5a-49a9-94f0-9cd25ae6c3b2">
    <a href="//privacy.truste.com/privacy-seal/Roblox-Corporation/validation?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" title="TRUSTe Children privacy certification" target="_blank">
        <img style="border: none" src="//privacy-policy.truste.com/privacy-seal/Roblox-Corporation/seal?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" width="133" height="45" alt="TRUSTe Children privacy certification"/>
    </a>
</div>
        </div>
        <div class="right">
            <p class="Legalese">
    ROBLOX, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="http://corp.<?= $site_properties['hostname'] ?>/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2014. Patents pending.
    ROBLOX is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
</p>
        </div>
        <div class="clear"></div>
    </div>
</div>
        
        </div></div>
    </div>
    <div id="ChatContainer" style="position: fixed; bottom: 0; right: 0; z-index: 10020">
        
    </div>

        
        <script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
        <script type="text/javascript">
            _uacct = "UA-486632-1";
            _udn = "<?= $site_properties['hostname'] ?>";
            _uccn = "rbx_campaign";
            _ucmd = "rbx_medium";
            _ucsr = "rbx_source";
            urchinTracker();
            __utmSetVar('Visitor/Anonymous');
        </script>
    

    

<script type="text/javascript">
//<![CDATA[
if(typeof __utmSetVar !== 'undefined'){ __utmSetVar(''); }if(typeof __utmSetVar !== 'undefined'){ __utmSetVar('Roblox_Item_Top_728x90'); }//]]>
</script>
</form>
    
    
    
<div id="InstallationInstructions"  class="modalPopup blueAndWhite" style="display:none;overflow:hidden" >
    <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
    <div style="padding-bottom:10px;text-align:center">
        <br /><br />
    </div>
</div>


<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>


<script type='text/javascript' src='http://js.rbxcdn.com/cc9a4f801eba175009511103c88a7aa1.js'></script>

<script type="text/javascript">
    Roblox.Client._skip = '/install/unsupported.aspx';
    Roblox.Client._CLSID = '';
    Roblox.Client._installHost = '';
    Roblox.Client.ImplementsProxy = false;
    Roblox.Client._silentModeEnabled = false;
    Roblox.Client._bringAppToFrontEnabled = false;

         Roblox.Client._installSuccess = function() { GoogleAnalyticsEvents && GoogleAnalyticsEvents.ViewVirtual('InstallSuccess'); };
</script>

<div id="PlaceLauncherStatusPanel" style="display:none;width:300px">
    <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
        <div id="Spinner" class="Spinner" style="margin:0 1em 1em 0; padding:20px 0;">
            <img src="http://images.rbxcdn.com/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
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


<script type='text/javascript' src='http://js.rbxcdn.com/507606ba77acf2ff29dd3ec7cb668f06.js'></script>

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
            <a href="/Upgrades/BuildersClubMemberships.aspx?ref=vpr" target="_blank" id="videoPrerollJoinBCButton"></a>
        </div>
    </div>
    <script type="text/javascript">
        Roblox.VideoPreRoll.showVideoPreRoll = false;
        Roblox.VideoPreRoll.loadingBarMaxTime = 30000;
        Roblox.VideoPreRoll.videoOptions.key = "robloxcorporation";
        Roblox.VideoPreRoll.videoOptions.categories = "NonBC,IsLoggedIn,AgeUnknown,GenderUnknown";
             Roblox.VideoPreRoll.videoOptions.id = "games";
        Roblox.VideoPreRoll.videoLoadingTimeout = 11000;
        Roblox.VideoPreRoll.videoPlayingTimeout = 23000;
        Roblox.VideoPreRoll.videoLogNote = "NotWindows";
        Roblox.VideoPreRoll.logsEnabled = true;
        Roblox.VideoPreRoll.excludedPlaceIds = "32373412";
            
                Roblox.VideoPreRoll.specificAdOnPlacePageEnabled = true;
                Roblox.VideoPreRoll.specificAdOnPlacePageId = 57507247;
                Roblox.VideoPreRoll.specificAdOnPlacePageCategory = "stooges";
            
            
                Roblox.VideoPreRoll.specificAdOnPlacePage2Enabled = true;
                Roblox.VideoPreRoll.specificAdOnPlacePage2Id = 122911678;
                Roblox.VideoPreRoll.specificAdOnPlacePage2Category = "lego";
            
        $(Roblox.VideoPreRoll.checkEligibility);
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
        <div class="RevisedFooter" >
            <div style="width:200px;margin:10px auto 0 auto;">
                <a href="#" onclick="redirectPlaceLauncherToRegister(); return false;"><div class="RevisedCharacterSelectSignup"></div></a>
                <a class="HaveAccount" href="#" onclick="redirectPlaceLauncherToLogin();return false;">I have an account</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function checkRobloxInstall() {
                 window.location= '/install/unsupported.aspx'; return false;
    }
        if (typeof MadStatus === "undefined") {
            MadStatus = {};
        }

        MadStatus.Resources = {
            //<sl:translate>
            accelerating: "Accelerating",
			aggregating: "Aggregating",
			allocating: "Allocating",
            acquiring: "Acquiring",
			automating: "Automating",
			backtracing: "Backtracing",
			bloxxing: "Bloxxing",
			bootstrapping: "Bootstrapping",
			calibrating: "Calibrating",
			correlating: "Correlating",
			denoobing: "De-noobing",
			deionizing: "De-ionizing",
			deriving: "Deriving",
            energizing: "Energizing",
			filtering: "Filtering",
			generating: "Generating",
			indexing: "Indexing",
			loading: "Loading",
			noobing: "Noobing",
			optimizing: "Optimizing",
			oxidizing: "Oxidizing",
			queueing: "Queueing",
			parsing: "Parsing",
			processing: "Processing",
			rasterizing: "Rasterizing",
			reading: "Reading",
			registering: "Registering",
			rerouting: "Re-routing",
			resolving: "Resolving",
			sampling: "Sampling",
			updating: "Updating",
			writing: "Writing",
            blox: "Blox",
			countzero: "Count Zero",
			cylon: "Cylon",
			data: "Data",
			ectoplasm: "Ectoplasm",
			encryption: "Encryption",
			event: "Event",
			farnsworth: "Farnsworth",
			bebop: "Bebop",
			fluxcapacitor: "Flux Capacitor",
			fusion: "Fusion",
			game: "Game",
			gibson: "Gibson",
			host: "Host",
			mainframe: "Mainframe",
			metaverse: "Metaverse",
			nerfherder: "Nerf Herder",
			neutron: "Neutron",
			noob: "Noob",
			photon: "Photon",
			profile: "Profile",
			script: "Script",
			skynet: "Skynet",
			tardis: "TARDIS",
			virtual: "Virtual",
            analogs: "Analogs",
			blocks: "Blocks",
			cannon: "Cannon",
			channels: "Channels",
			core: "Core",
			database: "Database",
			dimensions: "Dimensions",
			directives: "Directives",
			engine: "Engine",
			files: "Files",
			gear: "Gear",
			index: "Index",
			layer: "Layer",
			matrix: "Matrix",
			paradox: "Paradox",
			parameters: "Parameters",
			parsecs: "Parsecs",
			pipeline: "Pipeline",
			players: "Players",
			ports: "Ports",
			protocols: "Protocols",
			reactors: "Reactors",
			sphere: "Sphere",
			spooler: "Spooler",
			stream: "Stream",
			switches: "Switches",
			table: "Table",
			targets: "Targets",
			throttle: "Throttle",
			tokens: "Tokens",
			torpedoes: "Torpedoes",
			tubes: "Tubes"
            //</sl:translate>
        };
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

<div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
    <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
    <div class="Title"></div>
    <div class="GenericModalBody">
        <div class="TopBody">
            <div class="ImageContainer roblox-item-image"  data-image-size="small" data-no-overlays data-no-click>
                <img class="GenericModalImage" alt="generic image" />
            </div>
            <div class="Message"></div>
        </div>
        <div class="ConfirmationModalButtonContainer">
            <a href roblox-confirm-btn><span></span></a>
            <a href roblox-decline-btn><span></span></a>
        </div>
        <div class="ConfirmationModalFooter">
        
        </div>  
    </div>   
    <script type="text/javascript">
        //<sl:translate>
        Roblox.GenericConfirmation.Resources = { yes: "Yes", No: "No" }
        //</sl:translate>
    </script>
</div>


        <img src="https://secure.adnxs.com/seg?add=550800&t=2" width="1" height="1" style="display:none;"/>

</body>                
</html>
