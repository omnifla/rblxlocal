<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Web\SiteAlert;
$user = Auth::GetAuthenticatedUserInfo();
?>


<!DOCTYPE html>
<!--[if IE 8]><html class="ie8" ng-app="robloxApp"><![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->
<head>
    <!-- MachineID: WEB148 -->
    <title><?= $site_properties['hostname'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="RBLX.local" />
    <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." />
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
    <meta name="apple-itunes-app" content="app-id=431946152" />

    
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />

    
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700" rel="stylesheet" type="text/css">

    
    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=leanbase___f9e2a82b042c4b4f945b16e30fb19e87_m.css' />

    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___52e1333032abbfe57232ff9286d273ad_m.css' />

    
    
    
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>


    
    <script type='text/javascript' src='http://js.rbxcdn.com/35442da4b07e6a0ed6b085424d1a52cb.js'></script>


    
    
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

    <script type="text/javascript">
    googletag.cmd.push(function() {
        Roblox = Roblox || {};
        Roblox.AdsHelper = Roblox.AdsHelper || {};
        Roblox.AdsHelper.slots = [];
        Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Games_Middle_300x250", [300, 250], "3437353839393933").addService(googletag.pubads()), id: "3437353839393933", path: "/1015347/Roblox_Games_Middle_300x250"});
Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Games_Middle_300x250_1", [300, 250], "3434363239373535").addService(googletag.pubads()), id: "3434363239373535", path: "/1015347/Roblox_Games_Middle_300x250_1"});

        for (var key in Roblox.AdsHelper.slots) {
            var slot = Roblox.AdsHelper.slots[key].slot;
            var id = Roblox.AdsHelper.slots[key].id;
            var path = Roblox.AdsHelper.slots[key].path;

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
    var Roblox = Roblox || {};
    Roblox.AdsHelper = Roblox.AdsHelper || {};

    Roblox.AdsHelper.toggleAdsSlot = function (slotId, GPTRandomSlotIdentifier) {
        var gutterAdsEnabled = false;
        if (gutterAdsEnabled) {
            googletag.display(GPTRandomSlotIdentifier);
            return;
        }
        
        if (typeof slotId !== 'undefined' && slotId && slotId.length > 0) {
            var slotElm = $("#"+slotId);
            if (slotElm.is(":visible")) {
                googletag.display(GPTRandomSlotIdentifier);
            }else {
                switch(slotId) {
                    case "Skyscraper-Adp-Left":
                        Roblox.AdsHelper.adLeftTemplate = slotElm.html();
                        slotElm.empty();
                        break;
                    case "Skyscraper-Adp-Right":
                        Roblox.AdsHelper.adRightTemplate = slotElm.html();
                        slotElm.empty();
                        break;
                    case "Leaderboard-Abp":
                        Roblox.AdsHelper.adLeaderboardTemplate = slotElm.html();
                        slotElm.empty();
                        break;
                    case "GamePageAdDiv1":
                        Roblox.AdsHelper.adGamePageAdDiv1Template = slotElm.html();
                        slotElm.empty();
                        break;
                    case "GamePageAdDiv2":
                        Roblox.AdsHelper.adGamePageAdDiv2Template = slotElm.html();
                        slotElm.empty();
                        break;
                    case "GamePageAdDiv3":
                        Roblox.AdsHelper.adGamePageAdDiv3Template = slotElm.html();
                        slotElm.empty();
                        break;
                    case "ProfilePageAdDiv1":
                        Roblox.AdsHelper.adProfilePageAdDiv1Template = slotElm.html();
                        slotElm.empty();
                        break;
                    case "ProfilePageAdDiv2":
                        Roblox.AdsHelper.adProfilePageAdDiv2Template = slotElm.html();
                        slotElm.empty();
                        break;
                    default:
                        return;
                } 
            }
        }
    }
</script><script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script>    <script type="text/javascript">
        $(function () {
            RobloxEventManager.triggerEvent('rbx_evt_newuser', {});
        });

    </script>

            <script type="text/javascript" src="http://cdn.gigya.com/js/gigya.js?apiKey=3_OsvmtBbTg6S_EUbwTPtbbmoihFY5ON6v6hbVrTbuqpBs7SyF_LQaJwtwKJ60sY1p"></script>



    
    <!--[if lt IE 9]>
        <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
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
            <script type="text/javascript">
            $(function() {
                if (Roblox.EventStream) {
                    Roblox.EventStream.InitializeEventStream("http://ecsv2.aftwld.xyz/www/e.png");
                }
            });
        </script>

    
    
</head>
<body>
    
    


<div id="fb-root"></div>
<?php $classcheck = $user ? 'logged-in' : 'logged-out'; ?>
<div class="wrap no-gutter-ads <?= $classcheck ?>"
     data-gutter-ads-enabled="false">


<?= SiteHeader::render() ?>

    <div class="container-main    ">
            <script type="text/javascript">
                if (top.location != self.location) {
                    top.location = self.location.href;
                }
            </script>
        <noscript><div class="SystemAlert"><div class="rbx-alert-info" role="alert">Please enable Javascript to use all the features on this site.</div></div></noscript>
        <div class="content  ">

                                    




<div id="ResponsiveWrapper" class="games-responsive-wrapper "
     data-gamessearchonpage="true"
     data-adsingamesearchresultsenabled="true">

   
    
    <div id="GamesPageRightColumn" class="games-page-right">
        <div id="GamesPageRightColumnSidebar" class="sidebar-no-ad games-page-right-sidebar">
                    <div id="GamePageAdDiv1" class="ads-container">


<div style="width: 300px; " class="abp adp-gpt-container">
    <span id='3437353839393933' class="GPTAd rectangle" data-js-adtype="gptAd">
    </span>
        <div class="ad-annotations " style="width: 300px">
            <span class="ad-identification">
                Advertisement
                    <span> - </span>
                    <a href="" class="UpsellAdButton" title="Click to learn how to remove ads!">Why am I seeing ads?</a>
            </span>
                <a class="BadAdButton" href="/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
        </div>
    <script type="text/javascript">
        googletag.cmd.push(function () {
            if (typeof Roblox.AdsHelper !== "undefined" && typeof Roblox.AdsHelper.toggleAdsSlot !== "undefined") {
                Roblox.AdsHelper.toggleAdsSlot("GamePageAdDiv1", "3437353839393933");
            } else {
                googletag.display("3437353839393933");
            }
        });
    </script>
</div>


                    </div>
                        <div id="GamePageAdDiv2" class="ads-container">


<div style="width: 300px; " class="abp adp-gpt-container">
    <span id='3434363239373535' class="GPTAd rectangle" data-js-adtype="gptAd">
    </span>
        <div class="ad-annotations " style="width: 300px">
            <span class="ad-identification">
                Advertisement
                    <span> - </span>
                    <a href="" class="UpsellAdButton" title="Click to learn how to remove ads!">Why am I seeing ads?</a>
            </span>
                <a class="BadAdButton" href="/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
        </div>
    <script type="text/javascript">
        googletag.cmd.push(function () {
            if (typeof Roblox.AdsHelper !== "undefined" && typeof Roblox.AdsHelper.toggleAdsSlot !== "undefined") {
                Roblox.AdsHelper.toggleAdsSlot("GamePageAdDiv2", "3434363239373535");
            } else {
                googletag.display("3434363239373535");
            }
        });
    </script>
</div>


                        </div>

        </div>
    </div>

    <div id="GamesPageLeftColumn" class="games-page-left ">

        <!-- New Filters and sort -->
        
           

<div class="col-xs-12 games-page-filters loading" id="FiltersAndSort"
     data-defaulttoppaidtoweekly="true"
     data-defaultweeklyratings="true"
    >
    
        <div class="input-group-btn rbx-input-group-btn" id="SortFilter">
            <button type="button" class="rbx-input-dropdown-btn" data-toggle="dropdown">
                <span class="rbx-selection-label" data-bind="label" data-value="default" data-default="default">Filter by</span>
                <span class="rbx-icon-down-16x16"></span>
            </button>
            <ul data-toggle="dropdown-menu" class="rbx-dropdown-menu" role="menu">
                <li data-hidetimefilter data-value="default"><a href="#">Default</a></li>
                        <li data-hidetimefilter
                            
                            data-value="1">
                            <a href="#">Popular</a>
                        </li>
                        <li data-hidetimefilter
                            
                            data-value="8">
                            <a href="#">Top Earning</a>
                        </li>
                        <li 
                            
                            data-value="11">
                            <a href="#">Top Rated</a>
                        </li>
                        <li data-hidetimefilter
                            
                            data-value="16">
                            <a href="#">Recommended</a>
                        </li>
                        <li data-hidetimefilter
                            data-hidegenrefilter
                            data-value="3">
                            <a href="#">Featured</a>
                        </li>
                        <li 
                            
                            data-value="2">
                            <a href="#">Top Favorite</a>
                        </li>
                        <li 
                            
                            data-value="9">
                            <a href="#">Top Paid</a>
                        </li>
                        <li 
                            
                            data-value="14">
                            <a href="#">Builders Club</a>
                        </li>

            </ul>

        </div>

    <div class="input-group-btn rbx-input-group-btn" id="TimeFilter">
        <button type="button" class="rbx-input-dropdown-btn" data-toggle="dropdown">
            <span class="rbx-selection-label" data-bind="label" data-value="0" data-default="0">Time</span>
            <span class="rbx-icon-down-16x16"></span>
        </button>
        <ul data-toggle="dropdown-menu" class="rbx-dropdown-menu" role="menu">
            <li data-value="0" class="hidden"><a href="#">Now</a></li>
            <li data-value="1"><a href="#">Past Day</a></li>
            <li data-value="2"><a href="#">Past Week</a></li>
            <li data-value="4"><a href="#">All Time</a></li>
        </ul>
    </div>

    <div class="input-group-btn rbx-input-group-btn" id="GenreFilter">
        <button type="button" class="rbx-input-dropdown-btn" data-toggle="dropdown">
            <span class="rbx-selection-label" data-bind="label" data-value="1" data-default="1">Genre</span>
            <span class="rbx-icon-down-16x16"></span>
        </button>
        <ul data-toggle="dropdown-menu" class="rbx-dropdown-menu" role="menu">
                <li data-value="1"><a href="#">All</a></li>
                <li data-value="13"><a href="#">Adventure</a></li>
                <li data-value="19"><a href="#">Building</a></li>
                <li data-value="15"><a href="#">Comedy</a></li>
                <li data-value="10"><a href="#">Fighting</a></li>
                <li data-value="20"><a href="#">FPS</a></li>
                <li data-value="11"><a href="#">Horror</a></li>
                <li data-value="8"><a href="#">Medieval</a></li>
                <li data-value="17"><a href="#">Military</a></li>
                <li data-value="12"><a href="#">Naval</a></li>
                <li data-value="21"><a href="#">RPG</a></li>
                <li data-value="9"><a href="#">Sci-Fi</a></li>
                <li data-value="14"><a href="#">Sports</a></li>
                <li data-value="7"><a href="#">Town and City</a></li>
                <li data-value="16"><a href="#">Western</a></li>
        </ul>
    </div>

</div>

        <div id="GamesPageSearch" class="hidden" data-keyword="">
            <a name="CancelSearch" class="cancel-search">Cancel</a>
            <input data-default="" id="searchbox" class="translate" type="text" name="search" />
            <div class="SearchIconButton" title="Search"></div>
        </div>

        <div id="GamesListsContainer" class="games-page-lists-container">



<div class="games-list-container hidden container-0" id="GamesListContainer1"
     data-sortfilter="1"
     data-gamefilter="1"
     data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
            <h3>Popular</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral rbx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist games"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist games">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>



<div class="games-list-container hidden container-1" id="GamesListContainer8"
     data-sortfilter="8"
     data-gamefilter="1"
     data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
            <h3>Top Earning</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral rbx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist games"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist games">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>



<div class="games-list-container hidden container-2" id="GamesListContainer11"
     data-sortfilter="11"
     data-gamefilter="1"
     data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
            <h3>Top Rated</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral rbx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist games"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist games">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>



<div class="games-list-container hidden container-3" id="GamesListContainer16"
     data-sortfilter="16"
     data-gamefilter="1"
     data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
            <h3>Recommended</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral rbx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist games"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist games">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>



<div class="games-list-container hidden container-4" id="GamesListContainer3"
     data-sortfilter="3"
     data-gamefilter="1"
     data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
            <h3>Featured</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral rbx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist games"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist games">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>



<div class="games-list-container hidden container-5" id="GamesListContainer2"
     data-sortfilter="2"
     data-gamefilter="1"
     data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
            <h3>Top Favorite</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral rbx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist games"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist games">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>



<div class="games-list-container hidden container-6" id="GamesListContainer9"
     data-sortfilter="9"
     data-gamefilter="1"
     data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
            <h3>Top Paid</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral rbx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist games"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist games">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>



<div class="games-list-container hidden container-7" id="GamesListContainer14"
     data-sortfilter="14"
     data-gamefilter="1"
     data-minbclevel="0">
    <div class="games-list-header games-filter-changer">
            <h3>Builders Club</h3>

    </div>
    <div class="show-in-multiview-mode-only">
        <div class="see-all-button games-filter-changer btn-medium btn-neutral rbx-btn-secondary-xs btn-more">
            See All
        </div>
    </div>

    <div class="games-list">
        <div class="show-in-multiview-mode-only">
            <div class="horizontally-scrollable">
                    <ul class="hlist games"></ul>
            </div>

            <div class="scroller prev hidden">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-left"></span>
                    
                </div>
            </div>
            <div class="scroller next">
                <div class="arrow">
                        <span class="rbx-icon-games-carousel-right"></span>
                </div>
            </div>
        </div>

        <ul class="hlist games">            
            <div class="abp-spacer "></div>
        </ul>
    </div>
</div>


            <!-- on page search results container-->
            <div class="games-list-container hidden search-results-container" id="SearchResultsContainer">
                <div class="games-list-header">
                    <h3>Results for <span class="search-query-text"></span></h3>
                </div>
                <div class="games-list">
                    <ul class="list-item games"></ul>
                    <div class="abp-spacer "></div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function() {

        Roblox.SearchBox = {};
        Roblox.SearchBox.Resources = {
            //<sl:translate>
            search: "Search",
            zeroResults: "No Search Results Found"
            //</sl:translate>
        };
        Roblox.GamesPageContainerBehavior.Resources = {
            //<sl:translate>
            pageTitle: "ROBLOX Games - Browse our selection of free online games"
            //</sl:translate>
        };

        var defaultGamesListsCsv = "1,8,11,16,3";
        Roblox.GamesPageContainerBehavior.FilterValueToGamesListsIdSuffixMapping = {"default": defaultGamesListsCsv.split(',')};

        Roblox.GamesPageContainerBehavior.IsUserLoggedIn = false;
        Roblox.GamesPageContainerBehavior.adRefreshRateMilliSeconds = 3000;
        Roblox.GamesPageContainerBehavior.DeviceTypeId = 1;
        Roblox.GamesPageContainerBehavior.isCreateNewAd = true;
        Roblox.GamesPageContainerBehavior.setIntervalId = null;
        Roblox.GamesListBehavior.RefreshAdsInGamesPageEnabled = true;
        Roblox.GamesListBehavior.isUserEligibleForMultirowFirstSort = false;

    })

</script>

            
        </div>
            </div> 


<div id="fb-root"></div>
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0&appId=e58f2110adf82c2c00e6ae41c665510c";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?= SiteFooter::renderNextStyleGuide() ?>


<script src="https://apis.google.com/js/platform.js"></script></div> 



    <script type="text/javascript">function urchinTracker() {}</script>

<?php $isUserLoggedInCheck = $user ? 'True' : 'False'; ?>
<div id="PlaceLauncherStatusPanel" style="display:none;width:300px"
     data-new-plugin-events-enabled="True"
     data-event-stream-for-plugin-enabled="True"
     data-event-stream-for-protocol-enabled="True"
     data-is-protocol-handler-launch-enabled="True"
     data-is-user-logged-in="<?= $isLoggedIn ?>"
     data-os-name="Windows"
     data-protocol-name-for-client="roblox-player"
     data-protocol-name-for-studio="roblox-studio"
     data-protocol-url-includes-launchtime="true"
     data-protocol-detection-enabled="true">
    <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
        <div id="Spinner" class="Spinner" style="padding:20px 0;">
            <img src="http://images.rbxcdn.com/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
        </div>
        <div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
            <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
                Starting RBLX.local...
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
                RBLX.local is now loading. Get ready to play!
            </p>
            <div class="ph-startingdialog-spinner-row">
                <img src="http://images.rbxcdn.com/4bed93c91f909002b1f17f05c0ce13d1.gif" width="82" height="24" />
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
                    Download and Install RBLX.local
                </button>
            </div>
            <div class="rbx-small rbx-text-notes">
                <a href="https://en.help.roblox.com/hc/en-us/articles/204473560" class="rbx-link" target="_blank">Click here for help</a>
            </div>

        </div>
    </div>
</div>
<div id="ProtocolHandlerClickAlwaysAllowed" class="ph-clickalwaysallowed" style="display:none;">
    <p class="larger-font-size">
        <span class="rbx-icon-moreinfo"></span>
        Check <b>Remember my choice</b> and click <img src="http://images.rbxcdn.com/7c8d7a39b4335931221857cca2b5430b.png" alt="Launch Application" />  in the dialog box above to join games faster in the future!
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
            <a href="/Upgrades/BuildersClubMemberships.aspx?ctx=preroll" target="_blank" class="btn-medium btn-primary" id="videoPrerollJoinBCButton">Join Builders Club</a>
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
                Roblox.VideoPreRoll.videoLogNote = "Guest";
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
        <div class="RevisedFooter" >
            <div style="width:200px;margin:10px auto 0 auto;">
                <a href="/?returnUrl=%2Fgames%2F%3FSortFilter%3Ddefault%26TimeFilter%3D0%26GenreFilter%3D1"><div class="RevisedCharacterSelectSignup"></div></a>
                <a class="HaveAccount" href="/newlogin?returnUrl=%2Fgames%2F%3FSortFilter%3Ddefault%26TimeFilter%3D0%26GenreFilter%3D1">I have an account</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function checkRobloxInstall() {
             return RobloxLaunch.CheckRobloxInstall('/install/download.aspx');
    }

</script>

<div id="InstallationInstructions" style="display:none;">
    <div class="ph-installinstructions">
        <div class="ph-modal-header">
            <span class="rbx-icon-close simplemodal-close"></span>
            <h3>Thanks for playing RBLX.local</h3>
        </div>
        <div class="ph-installinstructions-body">
                <div class="ph-install-step ph-installinstructions-step1-of4">
                    <h1>1</h1>
                    <p class="larger-font-size">Click RobloxPlayerLauncher.exe to run the ROBLOX installer, which just downloaded via your web browser.</p>
                    <img width="230" height="180" src="http://images.rbxcdn.com/22ff09393bb9dc4093b85439f420a531.png" />
                </div>
                <div class="ph-install-step ph-installinstructions-step2-of4">
                    <h1>2</h1>
                    <p class="larger-font-size">Click <strong>Run</strong> when prompted by your computer to begin the installation process.</p>
                    <img width="230" height="180" src="http://images.rbxcdn.com/4a3f96d30df0f7879abde4ed837446c6.png" />
                </div>
                <div class="ph-install-step ph-installinstructions-step3-of4">
                    <h1>3</h1>
                    <p class="larger-font-size">Click <strong>Ok</strong> once you've successfully installed RBLX.local.</p>
                    <img width="230" height="180" src="http://images.rbxcdn.com/1889460e8475fd0bc24c6b57992b31d4.png" />
                </div>
                <div class="ph-install-step ph-installinstructions-step4-of4">
                    <h1>4</h1>
                    <p class="larger-font-size">After installation, click <strong>Play</strong> below to join the action!</p>
                    <div class="VisitButton VisitButtonContinuePH">
                        <a class="btn rbx-btn-primary-lg disabled">Play</a>
                    </div>
                </div>
        </div>
        <div class="rbx-font-sm rbx-text-notes">
            The RBLX.local installer should download shortly. If it doesn’t, <a href="#" onclick="Roblox.ProtocolHandlerClientInterface.startDownload(); return false;">start the download now.</a>
        </div>
    </div>
</div>
<div class="InstallInstructionsImage" data-modalwidth="970" style="display:none;"></div>



<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>

<script type='text/javascript' src='http://js.rbxcdn.com/453a3526187103f27673584103a84bc7.js'></script>

<script type="text/javascript">
    Roblox.Client._skip = null;
    Roblox.Client._CLSID = '76D50904-6780-4c8b-8986-1A7EE0B1716D';
    Roblox.Client._installHost = 'setup.aftwld.xyz';
    Roblox.Client.ImplementsProxy = true;
    Roblox.Client._silentModeEnabled = true;
    Roblox.Client._bringAppToFrontEnabled = false;
    Roblox.Client._currentPluginVersion = '';
    Roblox.Client._eventStreamLoggingEnabled = true;

        
        Roblox.Client._installSuccess = function() {
            if(GoogleAnalyticsEvents){
                GoogleAnalyticsEvents.ViewVirtual('InstallSuccess');
                GoogleAnalyticsEvents.FireEvent(['Plugin','Install Success']);
                if (Roblox.Client._eventStreamLoggingEnabled && typeof Roblox.GamePlayEvents != "undefined") {
                    Roblox.GamePlayEvents.SendInstallSuccess(Roblox.Client._launchMode, play_placeId);
                }
            }
        }
        
            
        if ((window.chrome || window.safari) && window.location.hash == '#chromeInstall') {
            window.location.hash = '';
            var continuation = '(' + $.cookie('chromeInstall') + ')';
            play_placeId = $.cookie('chromeInstallPlaceId');
            Roblox.GamePlayEvents.lastContext = $.cookie('chromeInstallLaunchMode');
            $.cookie('chromeInstallPlaceId', null);
            $.cookie('chromeInstallLaunchMode', null);
            $.cookie('chromeInstall', null);
            RobloxLaunch._GoogleAnalyticsCallback = function() { var isInsideRobloxIDE = 'website'; if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) { isInsideRobloxIDE = 'Studio'; };GoogleAnalyticsEvents.FireEvent(['Plugin Location', 'Launch Attempt', isInsideRobloxIDE]);GoogleAnalyticsEvents.FireEvent(['Plugin', 'Launch Attempt', 'Play']);EventTracker.fireEvent('GameLaunchAttempt_Win32', 'GameLaunchAttempt_Win32_Plugin'); if (typeof Roblox.GamePlayEvents != 'undefined') { Roblox.GamePlayEvents.SendClientStartAttempt(null, play_placeId); }  }; 
            Roblox.Client.ResumeTimer(eval(continuation));
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
    var Roblox = Roblox || {};
    Roblox.jsConsoleEnabled = false;
</script>





    
    <script type='text/javascript' src='http://js.rbxcdn.com/c979acb4c5c28f951f488faeb011b616.js'></script>


    
            <script type='text/javascript' src='http://js.rbxcdn.com/822491cace41a2d39fd76db6cfd17800.js'></script>

    
    
    <script type='text/javascript'>Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/1612c57544c7977e19cd15c824f7ecc3.js';Roblox.config.paths['Pages.CatalogShared'] = 'http://js.rbxcdn.com/209f2b781ea84e8d0332648ddf547d57.js';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/e8cbac58ab4f0d8d4c707700c9f97630.js';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/bbaeb48f3312bad4626e00c90746ffc0.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/7b436bae917789c0b84f40fdebd25d97.js';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/33d82b98045d49ec5a1f635d14cc7010.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/fbb86cf0752d23f389f983419d3085b4.js';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/8babd891cf420dfe3999b3824a0154cb.js';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/f2697119678d0851cfaa6c2270a727ed.js';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script>

    
    <script>
        Roblox.XsrfToken.setToken('x0WeExcxsvc6');
    </script>
    
        <script>
            $(function () {
                Roblox.DeveloperConsoleWarning.showWarning();
            });
        </script>
    <script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
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

    
    <script type='text/javascript' src='http://js.rbxcdn.com/bf9ca0ffd8520e3fe69a55b0e527d67e.js'></script>

</body>
</html>
