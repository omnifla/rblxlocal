<?php
// written by denied_id
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Web\SiteAlert;
?>


<!DOCTYPE html>
<!--[if IE 8]><html class="ie8" ng-app="robloxApp"><![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->
<head>
    <!-- MachineID: WEB153 -->
    <title><?= $site_properties['hostname'] ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ROBLOX Corporation" />
    <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." />
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
    <meta name="apple-itunes-app" content="app-id=431946152" />

    
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />

    
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700" rel="stylesheet" type="text/css">

    
    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=leanbase___b20c4ccd6a66671f293b5c013638ef01_m.css' />

    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___edc9cc743f96e22dbae2c813c21d85b8_m.css' />

    
    
    
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>


    
    <script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/35442da4b07e6a0ed6b085424d1a52cb.js'></script>


    
    
        <meta name="viewport" content="width =device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

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

    <div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer)\.aftwld\.xyz|robloxlabs\.com)((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))" data-regex-flags="gm"></div>
            <script type="text/javascript">
            $(function() {
                if (Roblox.EventStream) {
                    Roblox.EventStream.InitializeEventStream("http://ecsv2.<?= $site_properties['hostname'] ?>/www/e.png");
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

                                    
<div id="RobuxContainer" class="row robux-container">
    <div class="robux-header">
        <h1>Buy ROBUX</h1>
        <h3>&#153;</h3>
    </div>
    <ul class="grid robux-grid ">
        <li class="cell col-grid-12 robux-cell-header">
            <div class="cell-content">
                <div class="robux-header-icon">
                    <span class="rbx-icon-robux"></span>
                </div>
                <p class="robux-header-desc">
                    <span>ROBUX is the virtual currency used in many of our online games.</span>
                    <span>You can also use ROBUX for finding a great look for your character.</span>
                    <span>Get cool gear to take into multiplayer battles.</span>
                    <span>Buy Limited items to sell and trade.</span>
                    <span>You’ll need ROBUX to make it all happen. What are you waiting for?</span>
                </p>
            </div>
        </li>
    </ul>
    <ul class="grid robux-grid ">
            <li class="cell col-grid-4">
                <div class="cell-content">
                    <div class="robux-title">
                        <h1>400</h1>
                        <h2>ROBUX</h2>
                    </div>
                    <a  href="/Upgrades/PaymentMethods?ap=42&page=grid" class="rbx-btn-primary-sm robux-product-price btn-full-width robux-buy">Buy for $4.95</a>
                        <div class="robux-bonus-nbc">Want to get <span class="robux-bonus">50 Bonus ROBUX</span> ?
                        </div>
                        <a href=/Upgrades/BuildersClubMemberships.aspx?ap=42&amp;page=grid class="rbx-link"> Join Builders Club</a>
                </div>
            </li>
            <li class="cell col-grid-4">
                <div class="cell-content">
                    <div class="robux-title">
                        <h1>800</h1>
                        <h2>ROBUX</h2>
                    </div>
                    <a  href="/Upgrades/PaymentMethods?ap=45&page=grid" class="rbx-btn-primary-sm robux-product-price btn-full-width robux-buy">Buy for $9.95</a>
                        <div class="robux-bonus-nbc">Want to get <span class="robux-bonus">200 Bonus ROBUX</span> ?
                        </div>
                        <a href=/Upgrades/BuildersClubMemberships.aspx?ap=45&amp;page=grid class="rbx-link"> Join Builders Club</a>
                </div>
            </li>
            <li class="cell col-grid-4">
                <div class="cell-content">
                    <div class="robux-title">
                        <h1>2,000</h1>
                        <h2>ROBUX</h2>
                    </div>
                    <a  href="/Upgrades/PaymentMethods?ap=10&page=grid" class="rbx-btn-primary-sm robux-product-price btn-full-width robux-buy">Buy for $24.95</a>
                        <div class="robux-bonus-nbc">Want to get <span class="robux-bonus">750 Bonus ROBUX</span> ?
                        </div>
                        <a href=/Upgrades/BuildersClubMemberships.aspx?ap=10&amp;page=grid class="rbx-link"> Join Builders Club</a>
                </div>
            </li>
            <li class="cell col-grid-4">
                <div class="cell-content">
                    <div class="robux-title">
                        <h1>4,500</h1>
                        <h2>ROBUX</h2>
                    </div>
                    <a  href="/Upgrades/PaymentMethods?ap=46&page=grid" class="rbx-btn-primary-sm robux-product-price btn-full-width robux-buy">Buy for $49.95</a>
                        <div class="robux-bonus-nbc">Want to get <span class="robux-bonus">1,500 Bonus ROBUX</span> ?
                        </div>
                        <a href=/Upgrades/BuildersClubMemberships.aspx?ap=46&amp;page=grid class="rbx-link"> Join Builders Club</a>
                </div>
            </li>
            <li class="cell col-grid-4">
                <div class="cell-content">
                    <div class="robux-title">
                        <h1>10,000</h1>
                        <h2>ROBUX</h2>
                    </div>
                    <a  href="/Upgrades/PaymentMethods?ap=19&page=grid" class="rbx-btn-primary-sm robux-product-price btn-full-width robux-buy">Buy for $99.95</a>
                        <div class="robux-bonus-nbc">Want to get <span class="robux-bonus">5,000 Bonus ROBUX</span> ?
                        </div>
                        <a href=/Upgrades/BuildersClubMemberships.aspx?ap=19&amp;page=grid class="rbx-link"> Join Builders Club</a>
                </div>
            </li>
            <li class="cell col-grid-4">
                <div class="cell-content">
                    <div class="robux-title">
                        <h1>22,500</h1>
                        <h2>ROBUX</h2>
                    </div>
                    <a  href="/Upgrades/PaymentMethods?ap=21&page=grid" class="rbx-btn-primary-sm robux-product-price btn-full-width robux-buy">Buy for $199.95</a>
                        <div class="robux-bonus-nbc">Want to get <span class="robux-bonus">12,500 Bonus ROBUX</span> ?
                        </div>
                        <a href=/Upgrades/BuildersClubMemberships.aspx?ap=21&amp;page=grid class="rbx-link"> Join Builders Club</a>
                </div>
            </li>
    </ul>

    <div class="rbx-font-xs robux-footer">
        Prices for Turbo and Outrageous Builders Club are the same as for regular Builders Club. All sales are final. Please see our <a href="/info/terms-of-service" class="rbx-link-xs">Terms & Conditions</a> for more information.
    </div>
</div>

            
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
            <img src="https://s3.amazonaws.com/images.roblox.com/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
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
                <img src="https://s3.amazonaws.com/images.roblox.com/4bed93c91f909002b1f17f05c0ce13d1.gif" width="82" height="24" />
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
                <a href="https://en.help.roblox.com/hc/en-us/articles/204473560" class="rbx-link" target="_blank">Click here for help</a>
            </div>

        </div>
    </div>
</div>
<div id="ProtocolHandlerClickAlwaysAllowed" class="ph-clickalwaysallowed" style="display:none;">
    <p class="larger-font-size">
        <span class="rbx-icon-moreinfo"></span>
        Check <b>Remember my choice</b> and click <img src="https://s3.amazonaws.com/images.roblox.com/7c8d7a39b4335931221857cca2b5430b.png" alt="Launch Application" />  in the dialog box above to join games faster in the future!
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
            <a href="/Upgrades/BuildersClubMemberships.aspx?ref=vpr" target="_blank" class="btn-medium btn-primary" id="videoPrerollJoinBCButton">Join Builders Club</a>
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
                Roblox.VideoPreRoll.videoLogNote = "HTTPS";
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
                <a href="/?returnUrl=%2Fupgrades%2Frobux"><div class="RevisedCharacterSelectSignup"></div></a>
                <a class="HaveAccount" href="/newlogin?returnUrl=%2Fupgrades%2Frobux">I have an account</a>
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
            <h3>Thanks for playing ROBLOX</h3>
        </div>
        <div class="ph-installinstructions-body">
                <div class="ph-install-step ph-installinstructions-step1-of4">
                    <h1>1</h1>
                    <p class="larger-font-size">Click RobloxPlayerLauncher.exe to run the ROBLOX installer, which just downloaded via your web browser.</p>
                    <img width="230" height="180" src="https://s3.amazonaws.com/images.roblox.com/22ff09393bb9dc4093b85439f420a531.png" />
                </div>
                <div class="ph-install-step ph-installinstructions-step2-of4">
                    <h1>2</h1>
                    <p class="larger-font-size">Click <strong>Run</strong> when prompted by your computer to begin the installation process.</p>
                    <img width="230" height="180" src="https://s3.amazonaws.com/images.roblox.com/4a3f96d30df0f7879abde4ed837446c6.png" />
                </div>
                <div class="ph-install-step ph-installinstructions-step3-of4">
                    <h1>3</h1>
                    <p class="larger-font-size">Click <strong>Ok</strong> once you've successfully installed ROBLOX.</p>
                    <img width="230" height="180" src="https://s3.amazonaws.com/images.roblox.com/1889460e8475fd0bc24c6b57992b31d4.png" />
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
            The ROBLOX installer should download shortly. If it doesn’t, <a href="#" onclick="Roblox.ProtocolHandlerClientInterface.startDownload(); return false;">start the download now.</a>
        </div>
    </div>
</div>
<div class="InstallInstructionsImage" data-modalwidth="970" style="display:none;"></div>



<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>

<script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/c58c4d65bf2ed5c05e036534627c45d7.js'></script>

<script type="text/javascript">
    Roblox.Client._skip = null;
    Roblox.Client._CLSID = '76D50904-6780-4c8b-8986-1A7EE0B1716D';
    Roblox.Client._installHost = 'setup.roblox.com';
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





    
    <script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/c91f99a08fe1475198a54595b96c102e.js'></script>


    
        <script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/822491cace41a2d39fd76db6cfd17800.js'></script>

    
    
    <script type='text/javascript'>Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = 'https://s3.amazonaws.com/js.roblox.com/1612c57544c7977e19cd15c824f7ecc3.js';Roblox.config.paths['Pages.CatalogShared'] = 'https://s3.amazonaws.com/js.roblox.com/4eb48eec34ca711d5a7b08a4291ac753.js';Roblox.config.paths['Pages.Messages'] = 'https://s3.amazonaws.com/js.roblox.com/e8cbac58ab4f0d8d4c707700c9f97630.js';Roblox.config.paths['Resources.Messages'] = 'https://s3.amazonaws.com/js.roblox.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'https://s3.amazonaws.com/js.roblox.com/bbaeb48f3312bad4626e00c90746ffc0.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'https://s3.amazonaws.com/js.roblox.com/7b436bae917789c0b84f40fdebd25d97.js';Roblox.config.paths['Widgets.GroupImage'] = 'https://s3.amazonaws.com/js.roblox.com/33d82b98045d49ec5a1f635d14cc7010.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'https://s3.amazonaws.com/js.roblox.com/fbb86cf0752d23f389f983419d3085b4.js';Roblox.config.paths['Widgets.ItemImage'] = 'https://s3.amazonaws.com/js.roblox.com/838ec9c8067ba6fd6793a8bdbdb48a5c.js';Roblox.config.paths['Widgets.PlaceImage'] = 'https://s3.amazonaws.com/js.roblox.com/f2697119678d0851cfaa6c2270a727ed.js';Roblox.config.paths['Widgets.SurveyModal'] = 'https://s3.amazonaws.com/js.roblox.com/d6e979598c460090eafb6d38231159f6.js';</script>

    
    <script>
        Roblox.XsrfToken.setToken('Gy0SgFoHYF2Y');
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

    
    <script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/f1aac5995281c9bc2947c2111883e0ff.js'></script>

</body>
</html>
