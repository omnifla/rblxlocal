<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
$user = Auth::GetAuthenticatedUserInfo();
?>
<!DOCTYPE html>
<meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Language" content="en-us"/>
    <meta name="author" content="ROBLOX Corporation"/>
    <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine."/>
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine"/>
    
    
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0"/>


    <title><?= $site_properties['hostname'] ?></title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico"/>
    
    
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___b9201639e5888f0aebc69f624560f25c_m.css"/>

    
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___16fb75c02c4ac33ef3891c585687aa28_m.css"/>

    
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
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
<script type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js"></script>
<script type="text/javascript">window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

    
<script type="text/javascript" src="http://js.rbxcdn.com/b7f46e3b42d5a57293e87c67eb7be798.js"></script>

    <script type="text/javascript">Roblox.config.externalResources = ['/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = 'http://js.rbxcdn.com/29cf397a226a92ca602cb139e9aae7d7.js';Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/c8f61a230e6ad34193b40758f1499a3d.js';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/9d551a9e1b4c61c19e752fbed1a6da7c.js';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/a404577733d1b68e3056a8cd3f31614c.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/d83d02dd89808934b125fa21c362bcb9.js';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/3e692c7b60e1e28ce639184f793fdda9.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/e8b579b8e31f8e7722a5d10900191fe7.js';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/f676cf25d820c731b5adb4bf362bcd90.js';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/08e1942c5b0ef78773b03f02bffec494.js';Roblox.config.paths['Widgets.Suggestions'] = 'http://js.rbxcdn.com/a63d457706dfbc230cf66a9674a1ca8b.js';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script>
    
    
<script type="text/javascript" src="http://js.rbxcdn.com/b57b634508332bbdda35447f97556dd9.js"></script>

    <script type="text/javascript">
function Roblox_Games_Middle_300x250_RTP(estimate){rtp['/1015347/Roblox_Games_Middle_300x250'] = rp_valuation.estimate;}
var rtp = rtp || {};
oz_api="valuation";oz_site="9874/18868";oz_zone="58960";oz_ad_slot_size="300x250";oz_callback=Roblox_Games_Middle_300x250_RTP;
</script><script type="text/javascript" src="https:http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script><script>

function Roblox_Games_Middle_300x250_1_RTP(estimate){rtp['/1015347/Roblox_Games_Middle_300x250_1'] = rp_valuation.estimate;}
var rtp = rtp || {};
oz_api="valuation";oz_site="9874/18868";oz_zone="58960";oz_ad_slot_size="300x250";oz_callback=Roblox_Games_Middle_300x250_1_RTP;
</script><script type="text/javascript" src="https:http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script><script>

        googletag.cmd.push(function() {
            Roblox = Roblox || {};
            Roblox.AdsHelper = Roblox.AdsHelper || {};
            Roblox.AdsHelper.slots = [];
            Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Games_Middle_300x250", [300, 250], "3434303239323433").addService(googletag.pubads()), id: "3434303239323433", path: "/1015347/Roblox_Games_Middle_300x250"});
Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Games_Middle_300x250_1", [300, 250], "3435313931383130").addService(googletag.pubads()), id: "3435313931383130", path: "/1015347/Roblox_Games_Middle_300x250_1"});
 
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
<script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({'internalEventListenerPixelEnabled': true});
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
</script>        <script type="text/javascript">
            Roblox.XsrfToken.setToken('');
        </script>
    <script type="text/javascript">
        Roblox.FixedUI.gutterAdsEnabled = false;
    </script>   
    
</head>
<body class="">
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

            <div>

                                                            
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
                    <div class="forceSpace">&nbsp;</div>
                <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
                <div id="BodyWrapper">
                    <div id="RepositionBody">
                        <div id="Body" style="width:auto; min-width:970px;">
                            







<div id="ResponsiveWrapper" data-worseperformanceenabled="False" data-worseperformancedelay="0">  

    <div id="GamesPageRightColumn">
        <div id="GamesPageRightColumnSidebar" class="sidebar-no-ad">
                <div id="GamePageAdDiv1" class="ads-container">
<div style="width: 300px">
    <span id="3434303239323433" class="GPTAd rectangle" data-js-adtype="gptAd">
        <script type="text/javascript">
            googletag.cmd.push(function () {
                googletag.display("3434303239323433");
            });
        </script>
    </span>
    <div class="ad-annotations " style="width: 300px">
        <span class="ad-identification">Advertisement
            <span> - </span>
            <a href="" class="UpsellAdButton" title="Click to learn how to remove ads!">Why am I seeing ads?</a>
        </span>
            <a class="BadAdButton" href="http://www.roblox.com/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
    </div>
</div>                </div>
                    <div id="GamePageAdDiv2" class="ads-container">
<div style="width: 300px">
    <span id="3435313931383130" class="GPTAd rectangle" data-js-adtype="gptAd">
        <script type="text/javascript">
            googletag.cmd.push(function () {
                googletag.display("3435313931383130");
            });
        </script>
    </span>
    <div class="ad-annotations " style="width: 300px">
        <span class="ad-identification">Advertisement
            <span> - </span>
            <a href="" class="UpsellAdButton" title="Click to learn how to remove ads!">Why am I seeing ads?</a>
        </span>
            <a class="BadAdButton" href="http://www.roblox.com/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
    </div>
</div>                    </div>
        
            </div>
    </div>     
    
    <div id="GamesPageLeftColumn">


        <div id="GamesPageHeader">
            <h1><span class="games-filter-resetter">Games</span></h1>
        </div>

        
        <div id="FiltersAndSort" data-defaultweeklyratings="true">
            <div class="filter">
                <h3>Filter By: </h3>
                <select id="SortFilter" data-default="default">
                    <option data-hidetimefilter value="default">Default</option>
                    <option data-hidetimefilter value="0">Popular</option>
                    <option data-hidetimefilter value="8">Top Earning</option>
                    <option value="2">Top Favorite</option>
                    <option data-hidetimefilter data-hidegenrefilter value="3">Featured</option>
                    <option value="9">Top Paid</option>
                    <option value="11">Top Rated</option> 
                    <option data-hidetimefilter value="PersonalServers">Personal Servers</option>
                </select>
            </div>

            <div class="filter">
                <h3>Time: </h3>
                <select id="TimeFilter" data-default="0">
                    <option value="0">Now</option>
                    <option value="1">Past Day</option>
                    <option value="2">Past Week</option>
                    <option value="4">All Time</option>
                </select>
            </div>

            <div class="filter">
                <h3>Genre: </h3>
                <select id="GenreFilter" data-default="1">
                        <option value="1">All</option>
                        <option value="13">Adventure</option>
                        <option value="19">Building</option>
                        <option value="15">Comedy</option>
                        <option value="10">Fighting</option>
                        <option value="20">FPS</option>
                        <option value="11">Horror</option>
                        <option value="8">Medieval</option>
                        <option value="17">Military</option>
                        <option value="12">Naval</option>
                        <option value="21">RPG</option>
                        <option value="9">Sci-Fi</option>
                        <option value="14">Sports</option>
                        <option value="7">Town and City</option>
                        <option value="16">Western</option>
                </select>
            </div>
            
            <div id="GamesPageSearch">
                <input id="searchbox" class="translate" type="text" name="search" style="color:#888;height:20px;" onkeypress="if (event.keyCode == 13) { return Roblox.GamesDisplayShared.search(); }"/>
                <div class="SearchIconButton" onclick="Roblox.GamesDisplayShared.search()"></div>
            </div>

        </div>

        <div id="GamesListsContainer">





<div class="games-list-container hidden" id="GamesListContainer0" data-sortfilter="0" data-gamefilter="1" data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
	    <h2>Popular</h2>
    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/bf9c0660cdeb6283b71aa9237716519e.png"/>
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/ab6e44a9d9ebfde2244da961275acd06.png"/>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="games-list-container hidden" id="GamesListContainer8" data-sortfilter="8" data-gamefilter="1" data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
	    <h2>Top Earning</h2>
    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/bf9c0660cdeb6283b71aa9237716519e.png"/>
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/ab6e44a9d9ebfde2244da961275acd06.png"/>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="games-list-container hidden" id="GamesListContainer9" data-sortfilter="9" data-gamefilter="1" data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
	    <h2>Top Paid</h2>
    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/bf9c0660cdeb6283b71aa9237716519e.png"/>
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/ab6e44a9d9ebfde2244da961275acd06.png"/>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="games-list-container hidden" id="GamesListContainer11" data-sortfilter="11" data-gamefilter="1" data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
	    <h2>Top Rated</h2>
    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/bf9c0660cdeb6283b71aa9237716519e.png"/>
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/ab6e44a9d9ebfde2244da961275acd06.png"/>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="games-list-container hidden" id="GamesListContainerBC" data-sortfilter="0" data-gamefilter="1" data-minbclevel="1">
    <div class="games-list-header games-filter-changer">
	    <h2>Builders Club</h2>
    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/bf9c0660cdeb6283b71aa9237716519e.png"/>
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/ab6e44a9d9ebfde2244da961275acd06.png"/>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="games-list-container hidden" id="GamesListContainer2" data-sortfilter="2" data-gamefilter="1" data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
	    <h2>Top Favorite</h2>
    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/bf9c0660cdeb6283b71aa9237716519e.png"/>
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/ab6e44a9d9ebfde2244da961275acd06.png"/>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="games-list-container hidden" id="GamesListContainer3" data-sortfilter="3" data-gamefilter="1" data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
	    <h2>Featured</h2>
    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/bf9c0660cdeb6283b71aa9237716519e.png"/>
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/ab6e44a9d9ebfde2244da961275acd06.png"/>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="games-list-container hidden" id="GamesListContainerPersonalServers" data-sortfilter="0" data-gamefilter="2" data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
	    <h2>Personal Servers</h2>
    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/bf9c0660cdeb6283b71aa9237716519e.png"/>
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                    <img src="http://images.rbxcdn.com/ab6e44a9d9ebfde2244da961275acd06.png"/>
                </div>
            </div>
        </div>
    </div>
</div>

            <div id="DivToHideOverflowFromLastGamesList">
            </div>

        </div>

    </div>
</div>

<script type="text/javascript">
    Roblox.SearchBox = {};
    Roblox.SearchBox.Resources = {
        //<sl:translate>
        search: "Search"
        //</sl:translate>
    };
    Roblox.GamesPageContainerBehavior.Resources = {
        //<sl:translate>
        pageTitle: "ROBLOX Games - Browse our selection of free online games"
        //</sl:translate>
    };
    
    var defaultGamesLists = "0,8,9,11,BC";
    Roblox.GamesPageContainerBehavior.FilterValueToGamesListsIdSuffixMapping = {"default": defaultGamesLists.split(',')};
    
    Roblox.GamesPageContainerBehavior.IsUserLoggedIn = false;
    Roblox.GamesPageContainerBehavior.adRefreshRateMilliSeconds = 3000;

    Roblox.GamesPageContainerBehavior.PromptForEmailAddress = false;
    Roblox.GamesPageContainerBehavior.PromptForEmailAddressDelayInMs = 0;
</script>

                            <div style="clear:both"></div>
                        </div>
                    </div>
                </div>

<?= SiteFooter::render() ?>
