<?php
// written by meditext
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" style="--wm-toolbar-height: 67px;"><head>
    <title>ROBLOX</title>
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___3f022c119bae81d03158987f73441ea8_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=reset___90041b2af2fb6b9b7864ee66001ba812_m.css"> 
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___7784dd6e42c72aa68f642d792c3f9f15_m.css">
</head>

<body><div id="fb-root"></div>


    <div id="fb-root"></div>

    <div class=" no-gutter-ads">
        <div class="">
            <div class="">
                <div id="MasterContainer">
                    <script type="text/javascript">
                        if (top.location != self.location) {
                            top.location = self.location.href;
                        }
                    </script>

                    <script type="text/javascript">
                        $(function() {
                            function trackReturns() {
                                function dayDiff(d1, d2) {
                                    return Math.floor((d1-d2)/86400000);
                                }

                                var cookieName = 'RBXReturn';
                                var cookieOptions = {
                                    expires: 9001
                                };
                                var cookie = $.getJSONCookie(cookieName);

                                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                                    $.setJSONCookie(cookieName, {
                                        ts: new Date().toDateString()
                                    }, cookieOptions);
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
                        <div class="forceSpace">
                            &nbsp;
                        </div>
                        <noscript><div class="SystemAlert">
                            <div class="SystemAlertText">
                                Please enable Javascript to use all the features on this site.
                            </div>
                        </div>
                        </noscript>
                        <div class="site-header">
<div id="navigation-container">
    <a href="/Default.aspx" class="btn-logo" data-se="nav-logo"></a>
<div id="navigation-menu">
<ul>
    <li><a href="/home" ref="nav-myroblox" data-se="nav-myhome">Home</a></li>
    <li><a data-se="nav-games" href="/games" ref="nav-games" title="Games">Games</a> </li>
    <li><a data-se="nav-catalog" href="/Catalog" ref="nav-catalog" title="Catalog">Catalog</a></li>
    
    <li><a data-se="nav-leaderboards" href="/leaderboards" title="Leaderboards" ref="nav-leaderboards">Leaderboards</a></li>
    
    <li><a data-se="nav-upgrade" href="/Upgrades/BuildersClubMemberships.aspx" title="Builders Club" ref="nav-buildersclub">Builders Club</a></li>
    <li><a data-se="nav-forum" onclick="" href="/Forum/Default.aspx" style="" title="Forum" ref="nav-forum">Forum</a></li>
    <li class="more-list-item" drop-down-nav-button="more-list-item">
        <div class="more-link-container">
            <a id="nav-more" title="More" data-se="nav-more" ref="nav-more">More<span id="more-menu-toggle"></span></a> 
        </div>
        <div class="dropdownnavcontainer" style="display:none;" data-drop-down-nav-container="more-list-item">
            <div class="dropdownmainnav" style="z-index:1023">
                <a class="dropdownoption" data-se="nav-more-browse" href="/Browse.aspx" title="People" ref="nav-people"><span>People</span></a>
                <a class="dropdownoption roblox-interstitial" data-se="nav-more-blog" href="http://blog.localhost" title="Blog" ref="nav-news"><span>Blog</span></a>
                <a class="dropdownoption" data-se="nav-more-help" href="/Help/Builderman.aspx" title="Help" ref="nav-help"><span>Help</span></a>
                <div style="clear:both;"></div>
            </div>
        </div>
    </li>
</ul>
</div>
    <div id="header-login-container">
        <div id="header-login-wrapper" class="iframe-login-signup" data-display-opened="">
            <a id="header-signup" href="/Login/NewAge.aspx">Sign Up</a>
            <span id="header-or">or</span>
            <span id="login-span">
                <a id="header-login" class="btn-control btn-control-large">Login <span class="grey-arrow">▼</span></a>
            </span>
            <div id="iFrameLogin" style="display:none">
                <iframe class="login-frame" src="/Login/iFrameLogin.aspx?loginRedirect=False&amp;parentUrl=https%3a%2f%2fwww.localhost&gt;%2fNewLogin" scrolling="no" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>
</div>                        <div id="BodyWrapper">
                            <div id="RepositionBody">
                                <div id="Body" style="width:970px">
                                    <div style="width:100%;">
                                        <div style="margin-left:5px;">
                                            <h1 style="padding:0;">Buy ROBUX</h1>
                                            <div>
                                                <img width="48px" height="48px" alt="R$" src="https://web.archive.org/web/20140207123900im_/https://s3.amazonaws.com/images.roblox.com/72019d3cb1b2c8e1660b03b7423124c7.png" style="float:left;">
                                                <div class="rdar-text">
                                                    Use ROBUX to buy virtual goods for your character - shirts, pants, hats, faces, and even heads!
                                                    <br>
                                                    You can also buy gear, like hammers, potions, jet boots, swords, and BLOXI Cola.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="robux-products-container">
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=42" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        400 Robux $4.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 450 ROBUX for $4.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    400
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=45" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        800 Robux $9.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 1000 ROBUX for $9.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    800
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=10" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        2000 ROBUX $24.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 2750 ROBUX for $24.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    2000
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=46" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        4500 ROBUX $49.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 6000 ROBUX for $49.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    4500
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=19" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        10000 ROBUX $99.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 15000 ROBUX for $99.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    10000
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=21" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        22500 ROBUX $199.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 35000 ROBUX for $199.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    22500
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div style="font-size: 10px;">
                                                Prices for Turbo and Outrageous Builder's Club are the same as for regular Builder's Club. All sales are final. Please see our <a href="/web/20140207123900/https://www.roblox.com/info/terms-of-service">Terms &amp; Conditions</a> for more information.
                                            </div>

                                        </div>
                                    </div>


                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>

                            <div id="Footer" class="footer-container">
    <div class="FooterNav">
<a href="/info/Privacy.aspx">Privacy Policy</a>
&nbsp;|&nbsp; 
<a href="http://corp.' . host . '/advertise-on-roblox" class="roblox-interstitial">Advertise with Us</a>
&nbsp;|&nbsp; 
<a href="http://corp.' . host . '/roblox-press" class="roblox-interstitial">Press</a>
&nbsp;|&nbsp; 
<a href="http://corp.' . host . '/contact-us" class="roblox-interstitial">Contact Us</a>
&nbsp;|&nbsp;
<a href="http://corp.' . host . '/" class="roblox-interstitial">About Us</a>
&nbsp;|&nbsp;
<a href="http://blog.' . host . '" class="roblox-interstitial">Blog</a>
&nbsp;|&nbsp;
<a href="http://corp.' . host . '/jobs" class="roblox-interstitial">Jobs</a>
&nbsp;|&nbsp;
<a href="http://corp.' . host . '/parents" class="roblox-interstitial">Parents</a>
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
        <img style="border: none" src="/Images/TRUSTe/seal.png" width="133" height="45" alt="TRUSTe Children privacy certification">
    </a>
</div>
</div>
<div class="right">
    <p class="Legalese">
    RBLXLocal, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="http://corp.roblox.com/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2025. Patents pending.
   RBLXLocal is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, even the Roblox Platform. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
</p>
</div>
<div class="clear"></div>
    </div>
</div>    </div>

</div> 
</div> 
</div> 
</div> 


<div id="ChatContainer" style="position:fixed; bottom:0; right:0; z-index:10020;">


</div>


    <script type="text/javascript">function urchinTracker() {}</script>


<div id="PlaceLauncherStatusPanel" style="display:none;width:300px">
    <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
        <div id="Spinner" class="Spinner" style="margin:0 1em 1em 0; padding:20px 0;">
            <img src="https://s3.amazonaws.com/images.' . host . '/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress">
        </div>
        <div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
            <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
                Starting Roblox...
            </div>
            <div id="Waiting" class="PlaceLauncherStatus MadStatusField">Connecting to Players...</div>
            <div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div>
        </div>
        <div style="text-align:center;margin-top:1em">
            <input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel">
        </div>
    </div>
</div>



<script type="text/javascript" src="https://s3.amazonaws.com/js.roblox.com/507606ba77acf2ff29dd3ec7cb668f06.js"></script>

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
        Roblox.VideoPreRoll.loadingBarMaxTime = 33000;
        Roblox.VideoPreRoll.videoOptions.key = "robloxcorporation";
        Roblox.VideoPreRoll.videoOptions.categories = "NonBC,IsLoggedIn,AgeUnknown,GenderUnknown";
             Roblox.VideoPreRoll.videoOptions.id = "games";
        Roblox.VideoPreRoll.videoLoadingTimeout = 11000;
        Roblox.VideoPreRoll.videoPlayingTimeout = 41000;
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
        <div class="RevisedFooter">
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

    
<div id="InstallationInstructions" class="modalPopup blueAndWhite" style="display:none;overflow:hidden">
    <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
    <div style="padding-bottom:10px;text-align:center">
        <br><br>
    </div>
</div>
    
    
    
<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>
    
    
<script type="text/javascript" src="https://s3.amazonaws.com/js.roblox.com/d387e54149ead170a1a8d204d0e7f1ed.js"></script>
    
<script type="text/javascript">
    Roblox.Client._skip = '/install/unsupported.aspx';
    Roblox.Client._CLSID = '';
    Roblox.Client._installHost = '';
    Roblox.Client.ImplementsProxy = false;
    Roblox.Client._silentModeEnabled = false;
    Roblox.Client._bringAppToFrontEnabled = false;
    
         Roblox.Client._installSuccess = function() { GoogleAnalyticsEvents && GoogleAnalyticsEvents.ViewVirtual('InstallSuccess'); };
    </script>
                    

                
            
        
    


</body></html>