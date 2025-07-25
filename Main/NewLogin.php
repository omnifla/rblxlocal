<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\ConfirmationModal;
use Roblox\Web\SiteHeader;
if(Auth::GetAuthenticatedUser()){
    header("Location: /Home");
    exit;
}
// detect if its HTTP post
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['Username'] ?? $_POST['username'] ?? '';
    $password = $_POST['Password'] ?? $_POST['password'] ?? '';
    $returnUrl = $_POST['ReturnUrl'] ?? '/Home';
    
    try {
        Auth::Login($username, $password);
    } catch (\Exception $e) {
        exit($e->getMessage());
    }
    header("Location: " . $returnUrl);
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <!-- MachineID: WEB257 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="author" content="ROBLOX Corporation" />
    <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." />
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
    
    

    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
    
    

<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3731e5099a71e94e28c4df78e94fcc01_m.css' />

    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___bae5a64df734598d457f78134ba86e31_m.css' />

        
	<script type="text/javascript">

        var _gaq = _gaq || [];

		    _gaq.push(['_setAccount', 'UA-11419793-1']);
		    _gaq.push(['_setCampSourceKey', 'rbx_source']);
		    _gaq.push(['_setCampMediumKey', 'rbx_medium']);
		    _gaq.push(['_setCampContentKey', 'rbx_campaign']);
		        _gaq.push(['_setDomainName', '<?= $site_properties["hostname"] ?>']);
		_gaq.push(['b._setAccount', 'UA-486632-1']);
		_gaq.push(['b._setCampSourceKey', 'rbx_source']);
		_gaq.push(['b._setCampMediumKey', 'rbx_medium']);
		_gaq.push(['b._setCampContentKey', 'rbx_campaign']);

		_gaq.push(['b._setDomainName', '<?= $site_properties["hostname"] ?>']);
        
            _gaq.push(['b._setCustomVar', 1, 'Visitor', 'Anonymous', 2]);
            _gaq.push(['b._trackPageview']);    
        
        
        

		_gaq.push(['c._setAccount', 'UA-26810151-2']);
		_gaq.push(['c._setDomainName', '<?= $site_properties["hostname"] ?>']);

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

    
<script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/2a5ce47757f35b2741813080d8a7cc23.js'></script>

    <script type='text/javascript'>Roblox.config.externalResources = ['/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = 'https://s3.amazonaws.com/js.roblox.com/29cf397a226a92ca602cb139e9aae7d7.js';Roblox.config.paths['Pages.Catalog'] = 'https://s3.amazonaws.com/js.roblox.com/7123e398c0433de33356ac718bab90d5.js';Roblox.config.paths['Pages.CatalogShared'] = 'https://s3.amazonaws.com/js.roblox.com/4eb48eec34ca711d5a7b08a4291ac753.js';Roblox.config.paths['Pages.Messages'] = 'https://s3.amazonaws.com/js.roblox.com/9b1b88b531c486003bbf39ae61963c27.js';Roblox.config.paths['Resources.Messages'] = 'https://s3.amazonaws.com/js.roblox.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'https://s3.amazonaws.com/js.roblox.com/e62257426488086a962edc938c73af47.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'https://s3.amazonaws.com/js.roblox.com/ff651da6797160efb3ebbb2c2f98fb86.js';Roblox.config.paths['Widgets.GroupImage'] = 'https://s3.amazonaws.com/js.roblox.com/02a15e93afbd750f4d10a76c106d5993.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'https://s3.amazonaws.com/js.roblox.com/e8b579b8e31f8e7722a5d10900191fe7.js';Roblox.config.paths['Widgets.ItemImage'] = 'https://s3.amazonaws.com/js.roblox.com/cdf392f4ea913f856dd792de27a7e917.js';Roblox.config.paths['Widgets.PlaceImage'] = 'https://s3.amazonaws.com/js.roblox.com/95cde5634c888fd071eef0d20c23f0ce.js';Roblox.config.paths['Widgets.Suggestions'] = 'https://s3.amazonaws.com/js.roblox.com/a63d457706dfbc230cf66a9674a1ca8b.js';Roblox.config.paths['Widgets.SurveyModal'] = 'https://s3.amazonaws.com/js.roblox.com/d6e979598c460090eafb6d38231159f6.js';</script>
    
    
<script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/d0ba6b6557864e523bf57c51fb825489.js'></script>


<script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true, 'internalEventListenerPixelEnabled': true});
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
            Roblox.XsrfToken.setToken('');
        </script>
    <script type="text/javascript">
        Roblox.FixedUI.gutterAdsEnabled = false;
    </script>   
    
</head>
<body class="">
    


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

    
        RobloxListener.restUrl = window.location.protocol + "//" + "<?= $site_properties["hostname"] ?>/Game/EventTracker.ashx";
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
    
    
</script>            <style>
                html {
                    background: #123f83;
                }
            </style>
                            <div class="forceSpace">&nbsp;</div>
                                <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
            <!--
            <div class="SystemAlert" style="background-color:blue">
                <div class="SystemAlertText"><div> Player Points and Leaderboards have been reset. The beta test continues...</div></div>
            </div>
            -->
        <div id="BodyWrapper">
            <div id="RepositionBody">
                <div id="Body" style="width:970px">
                    
<!--[if IE 7]>
<style>        
    #signInButtonPanel a 
    {
        margin-right: 143px;
    }
</style>
<![endif]-->
<h1>Login to ROBLOX</h1>
<div>
<form action="/newlogin" id="loginForm" method="post">            <div id="loginarea" class="divider-bottom">
                <div id="leftArea">
                    <div id="loginPanel">   
                        <table id="logintable">
                            <tr id="username">
                                <td><label class="form-label" for="Username">Username:</label></td>
                                <td><input class="text-box text-box-medium" data-val="true" data-val-required="The Username field is required." id="Username" name="Username" type="text" value="" /></td>
                            </tr>
                            <tr id="password">
                                <td><label class="form-label" for="Password">Password:</label></td>
                                <td><input class="text-box text-box-medium" data-val="true" data-val-required="The Password field is required." id="Password" name="Password" type="password" /></td>
                            </tr>
                        </table>
			<div class="h-captcha" data-sitekey="e36ad4e6-536c-4f1a-baba-d2cc9804c9de"></div>
                        <div>
                        </div>
                        <div>
                            <div id="forgotPasswordPanel">
                                <a class="text-link" href="/Login/ResetPasswordRequest.aspx" target="_blank">Forgot your password?</a>
                            </div>
                            <div id="signInButtonPanel">
                                <a  roblox-js-onclick class="btn-medium btn-neutral">Sign In</a>
                                <a  roblox-js-oncancel class="btn-medium btn-negative">Cancel</a>
                            </div>
                            <div class="clearFloats">
                            </div>
                        </div>
                        <span id="fb-root">
                                    <div id="SplashPageConnect" class="fbSplashPageConnect">
                                        <a class="facebook-login" href="/Facebook/SignIn?returnTo=/home" ref="form-facebook">
                                            <span class="left"></span>
                                            <span class="middle">Login with Facebook<span>Login with Facebook</span></span>
                                            <span class="right"></span>
                                        </a>       
                                    </div>
                        </span>
                    </div>
                </div>
                <div id="rightArea" class="divider-left">
                    <div id="signUpPanel" class="FrontPageLoginBox">
                        <p class="text">Not a member?</p>
                        <h2>Sign Up to Build & Make Friends</h2>
                        <p class="text">What is your birthday?</p>
                        <select id="MonthSelect" class="form-select" name="Month">
                            <option>Month</option>
                        </select>
                        <select id="DaySelect" class="form-select" name="Day">
                            <option>Day</option>
                        </select>
                        <select id="YearSelect" class="form-select" name="Year">
                            <option>Year</option>
                        </select>
                        <p class="footnote" id="disclaimer">Your birthday will not be given out to any third party!</p>
<a  roblox-js-onsignup class="btn-medium btn-primary">Sign Up</a>                    </div>
                </div>
            </div>
<input id="ReturnUrl" name="ReturnUrl" type="hidden" value="" /></form>
</div>
<script type="text/javascript">
    if (typeof Roblox === "undefined") {
        Roblox = {};
    }
    if (typeof Roblox.Login === "undefined") {
        Roblox.Login = {};
    }

    Roblox.Login.Resources = {
        //<sl:translate>
        january: "January"
		, february: "February"
		, march: "March"
		, april: "April"
		, may: "May"
		, june: "June"
		, july: "July"
		, august: "August"
		, september: "September"
		, october: "October"
		, november: "November"
		, december: "December"
        //</sl:translate>
    };
</script>

<div id="guestarea">
    <h2>You don't need an account to play ROBLOX</h2>
    <br/>
    <p class="text">You can start playing right now, in guest mode! <a  href="/games" class="btn-small btn-neutral" id="guestButton">Play as Guest</a></p>
    
</div>
<script type="text/javascript">
    $(function() {{ RobloxEventManager.triggerEvent('rbx_evt_abtest', { experiment: 'MVCLoginPage', variation: 'MVCLoginPage'});}});
</script>
                    <div style="clear:both"></div>
                </div>
            </div>
        </div>
<div id="Footer" class="footer-container">
    <div class="FooterNav">
        <a href="/info/Privacy.aspx">Privacy Policy</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.<?= $site_properties["hostname"] ?>/advertise-on-roblox" class="roblox-interstitial">Advertise with Us</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.<?= $site_properties["hostname"] ?>/roblox-press" class="roblox-interstitial">Press</a>
        &nbsp;|&nbsp; 
        <a href="http://corp.<?= $site_properties["hostname"] ?>/contact-us" class="roblox-interstitial">Contact Us</a>
        &nbsp;|&nbsp;
        <a href="http://corp.<?= $site_properties["hostname"] ?>/" class="roblox-interstitial">About Us</a>
        &nbsp;|&nbsp;
        <a href="http://blog.<?= $site_properties["hostname"] ?>" class="roblox-interstitial">Blog</a>
        &nbsp;|&nbsp;
        <a href="http://corp.<?= $site_properties["hostname"] ?>/jobs" class="roblox-interstitial">Jobs</a>
        &nbsp;|&nbsp;
        <a href="http://corp.<?= $site_properties["hostname"] ?>/parents" class="roblox-interstitial">Parents</a>
            <span class="LanguageOptionElement">&nbsp;|&nbsp;</span>
            <span ref="footer-parents" class="LanguageOptionElement LanguageTrigger roblox-interstitial" drop-down-nav-button="LanguageTrigger">English&nbsp;<span class="FooterArrow">▼</span>
                <div class="dropuplanguagecontainer" style="display:none;" data-drop-down-nav-container="LanguageTrigger">
                    <div class="dropdownmainnav" style="z-index:1023">
                            <a href="/UserLanguage/LanguageRedirect?languageCode=de&amp;relativePath=%2fNewLogin"class="LanguageOption js-lang" data-js-langcode="de"><span class="notranslate">Deutsch</span>&nbsp;(German) </a>
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
    ROBLOX, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="http://corp.<?= $site_properties["hostname"] ?>/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2014. Patents pending.
    ROBLOX is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
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
            <img src="https://s3.amazonaws.com/images.<?= $site_properties["hostname"] ?>/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
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



<script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/507606ba77acf2ff29dd3ec7cb668f06.js'></script>

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


<div id="InstallationInstructions"  class="modalPopup blueAndWhite" style="display:none;overflow:hidden" >
    <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
    <div style="padding-bottom:10px;text-align:center">
        <br /><br />
    </div>
</div>



<div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
<iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>


<script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/d387e54149ead170a1a8d204d0e7f1ed.js'></script>

<script type="text/javascript">
    Roblox.Client._skip = '/install/unsupported.aspx';
    Roblox.Client._CLSID = '';
    Roblox.Client._installHost = '';
    Roblox.Client.ImplementsProxy = false;
    Roblox.Client._silentModeEnabled = false;
    Roblox.Client._bringAppToFrontEnabled = false;

         Roblox.Client._installSuccess = function() { GoogleAnalyticsEvents && GoogleAnalyticsEvents.ViewVirtual('InstallSuccess'); };
    </script>


<?= Roblox\Web\ConfirmationModal::render() ?>



</body>
</html>
