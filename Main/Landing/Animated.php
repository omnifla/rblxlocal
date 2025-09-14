<?php
// someone fix the redirect
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
header("Location: /"); // deprecated
exit();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_data = [
        "username" => $_POST['username'] ?? '',
        "password" => $_POST['password'] == $_POST['passwordConfirm'] ? $_POST["password"] : '!!!!!$IncorrectPassword!!!!!!',
        "gender" => $_POST['gender'] == "Male" ? 1 : 2,
        "birthdate" => $_POST["lstYears"]."-".$_POST["lstMonths"]."-".$_POST["lstDays"],
    ];
    if ($form_data["password"] === '!!!!!$IncorrectPassword!!!!!!') {
        echo json_encode([
            "success" => false,
            "message" => "Passwords do not match."
        ]);
        exit;
    }
    try {
        Auth::Register($form_data["username"], $form_data["password"], $form_data['gender'], null, $form_data["birthdate"]);
    } catch(\InvalidArgumentException $e) {
        echo json_encode([
            "success" => false,
            "message" => $e->getMessage()
        ]);
        exit;
    }
}
$returnUrl = $_GET['ReturnUrl'] ?? '/Home/';

if(Auth::GetAuthenticatedUser()){
    header("Location: " . urldecode($returnUrl));
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- MachineID: WEB<?= rand(10,500) ?> -->
        <title><?= $site_properties['Title'] ?></title>
        
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=reset___90041b2af2fb6b9b7864ee66001ba812_m.css' />

        
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css' />

        
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___bf097aaf84081a91c4009204ee516a8c_m.css' />

	<script type="text/javascript">

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
        
            _gaq.push(['b._setCustomVar', 1, 'Visitor', 'Anonymous', 2]);
            _gaq.push(['b._trackPageview']);    
        
        
        

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


    <script type="text/javascript">function urchinTracker() {}</script>

        <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

        
<script type='text/javascript' src='http://js.rbxcdn.com/e3f1e5f93579c3503efa176b82621407.js'></script>

            <script type="text/javascript">
        $(function () {
            RobloxEventManager.triggerEvent('rbx_evt_newuser', {});
        });

    </script>

        <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="/CSS/PartialViews/Navigation.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="ROBLOX Corporation" />
        <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." />
        <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
        <meta name="robots" content="all" />

        

        
    </head>
    <body>
        <div id="fb-root"></div>
        <script>    (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            } (document, 'script', 'facebook-jssdk'));</script>
        <div id="Container">
            
<div class="site-header">
    <div id="navigation-container">
        <a href="/Default.aspx" class="btn-logo" data-se="nav-logo"></a>
            <div id="header-login-container">
                <div id="header-login-wrapper" class="iframe-login-signup">
                    <a id="header-signup" href="/Login/NewAge.aspx">Sign Up</a>
                    <span id="header-or">or</span>
                    <span id="login-span">
		                <a id="header-login" class="btn-control btn-control-large">Login <span class="grey-arrow">▼</span></a>
                    </span>
	                <div id="iFrameLogin" style="display:none" runat="server" clientidmode="Static" >
	                    <iframe class="login-frame" src="https://<?= $site_properties["hostname"] ?>/Login/iFrameLogin.aspx?loginRedirect=True&amp;parentUrl=http%3a%2f%2f<?= $site_properties["hostname"] ?>%2fLanding%2fAnimated" scrolling="no" frameborder="0"></iframe>
                    </div>
	            </div>
            </div>	
    </div>
</div>  
            <div style="clear:both"></div>
            <div id="Body" style="width:970px">
                
<script type="text/javascript">
    Roblox = Roblox || {};

    Roblox.Resources = Roblox.Resources || {};

    Roblox.Resources.AnimatedSignupFormValidator = {
        //<sl:translate>
        doesntMatch: "Doesn't match",
        requiredField: "Required",
        tooLong: "Too long",
        tooShort: "Too short",
        maxValid: "Too many accounts use this email",
        needsFourLetters: "Needs 4 letters",
        needsTwoNumbers: "Needs 2 numbers",
        noSpaces: "No spaces allowed",
        weakKey: "Weak key combination.",
        invalidName: "Can't be your character name",
        alreadyTaken: "Already taken",
        cantBeUsed: "Can't be used",
        invalidBirthday: "Invalid birthday",
        loginFieldsRequired: "Username and Password are required.",
        loginFieldsIncorrect: "Your username or password is incorrect.",
        invalidEmail: "Invalid email"
        //</sl:translate>
    };
</script>
<style type="text/css">
    body {
        background: url("http://images.rbxcdn.com/437004fbc01bf6a613547a40aabde10a.jpg") repeat-x;
        padding-top: 35px;
    }
    #Container {
        background: url("http://images.rbxcdn.com/161d0d393d74c103e5f50eef988b7217.png") repeat-x;
    }
</style>
<div id="Experimental" class="ShadowedStandardBox" data-is-animated="False">
    <div class="Content">
        <div id="animatedHeader">
            <div id="headerLogo"><img src="http://images.rbxcdn.com/9b792179d6034ff15284a289ffedec15.png" alt="logo" /></div>
            <div id="headerTextTop">Join millions of builders</div>
            <div id="headerTextBottom">and explore their creations</div>
        </div>
        <div id="animatedBodyWrapper">
            <div id="animatedBody">
                    <div class="ImageContainer" style="float: left;">
                        <img src="http://images.rbxcdn.com/a53fcaef613b178ec86dc2937d677451.jpg" alt="Roblox Landing Page Image" width="380" height="250"/>
                        <div class="slogan-container">
                            <div id="slogan">What will you build?</div>
                        </div>
                    </div>
                <div id="animated-wrapper" data-first-visit="True">
                    <div class="sign-up-row">
                        <div class="sign-up-inner-row">
                            <span id="animated-tab-signup" class="animated-tab">Sign up</span>
                            <span class="animated-tab">|</span>
                            <span id="animated-tab-login" class="animated-tab">Login</span>
                        </div>
                    </div>
                    <div id="animated-login" style="display: none;">
                        <form method="post" id="login-form" action="https://<?= $site_properties["hostname"] ?>/newlogin">
                            <div class="sign-up-row">
                                <div class="sign-up-inner-row">
                                    <span id="login-error" class="required-text error" style="display: none;"></span>
                                </div>
                            </div>
                            <div class="sign-up-row">
                                <div>
                                    <input type="text" id="loginUsername" name="username" class="text-box text-box-large" tabindex="1" placeholder="Username" />
                                </div>
                            </div>
                            <div class="sign-up-row">
                                <div>
                                    <input type="password" id="loginPassword" name="password" class="text-box text-box-large" tabindex="2" placeholder="Password" />
                                </div>
                            </div>
			    <div class="sign-up-row">
                                <div class="h-captcha" data-sitekey="e36ad4e6-536c-4f1a-baba-d2cc9804c9de"></div>
                            </div>
                            <div>
                                <a  onclick="return Roblox.AnimatedLoginFormValidator.validateLoginForm();" tabindex="3" class="btn-large btn-primary" id="login-button">Login</a>
                            </div>
                        </form>
                        <br />
                        <div id="login-footer" class="sign-up-row">
                            <div class="sign-up-inner-row">
                                <a href="/Login/ResetPasswordRequest.aspx">Forgot your username/password?</a>
                            </div>
                            <div>
                                Don't have an account? <a href="#" onclick="$('#animated-tab-signup').click();"> Sign up</a>
                            </div>
                        </div>
                    </div>
                    <div id="animated-signup" style="display: none;">
                        <form method="post" id="signup-form" action="https://<?= $site_properties["hostname"] ?>/landing/animated">
                            <div class="sign-up-row">
                                <div class="sign-up-inner-row">
                                    <span id="birthdayGood" class="good-text" style="display: none;">OK</span> <span
                                                                                                                   id="birthdayError" class="required-text error" style="display: none;"></span>
                                    <span id="birthdayText">Birthday</span>
                                </div>
                                <div>
                                    <select id="lstMonths" name="lstMonths" onchange="Roblox.AnimatedSignupFormValidator.checkBirthday()" tabindex="1"><option selected="selected" value="0">Month</option>
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
                                    <select id="lstDays" name="lstDays" onchange="Roblox.AnimatedSignupFormValidator.checkBirthday()" tabindex="2"><option selected="selected" value="0">Day</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
                                    <select id="lstYears" name="lstYears" onchange="Roblox.AnimatedSignupFormValidator.checkBirthday(false)" tabindex="3"><option selected="selected" value="0">Year</option>
<?php
$currentYear = date("Y");
$startYear = $currentYear - 99;
for ($i = $currentYear; $i >= $startYear; $i--) {
    echo "<option value=\"$i\">$i</option>";
}
?>
</select>
                                </div>
                                <div>
                                    <span class="sign-up-description">
                                        Enter your birthday for a personalized experience.<br />
                                        It will not be given to any third party.
                                    </span>
                                </div>
                            </div>
                            <div class="sign-up-row">
                                <div class="sign-up-inner-row">
                                    <span id="genderGood" class="good-text" style="display: none;">OK</span>
                                    <span id="genderError" class="required-text error" style="display: none;"></span>
                                    <span id="genderText">Gender</span>
                                </div>
                                <div>
                                    <input id="MaleBtn" name="gender" onclick="Roblox.AnimatedSignupFormValidator.checkGender();" tabindex="4" type="radio" value="Male" />
                                    <label for="MaleBtn">Male</label>
                                    <input id="FemaleBtn" name="gender" onclick="Roblox.AnimatedSignupFormValidator.checkGender();" tabindex="5" type="radio" value="Female" />
                                    <label for="FemaleBtn">Female</label>
                                </div>
                            </div>
                            <div class="sign-up-row">
                                <div class="sign-up-inner-row">
                                    <span id="usernameGood" class="good-text" style="display: none;">OK</span>
                                    <span id="usernameError" class="required-text error" style="display: none;"></span>
                                    <span id="usernameText">Username</span>
                                </div>
                                <div>
                                    <input type="text" id="username" name="username" class="text-box text-box-large" tabindex="6" onblur="Roblox.AnimatedSignupFormValidator.checkUsername()" />
                                </div>
                                <div>
                                    <span class="sign-up-description">3-20 alphanumeric characters, no spaces</span>
                                </div>
                            </div>
                            <div class="sign-up-row">
                                <div class="sign-up-inner-row">
                                    <span id="passwordGood" class="good-text" style="display: none;">OK</span>
                                    <span id="passwordError" class="required-text error" style="display: none;"></span>
                                    <span id="passwordText">Password</span>
                                </div>
                                <div>
                                    <input name="password" id="password" class="text-box text-box-large" tabindex="7" type="password" onkeyup="Roblox.AnimatedSignupFormValidator.checkPassword();" />
                                </div>
                                <div>
                                    <span class="sign-up-description">6-20 characters, minimum of 4 letters & 2 numbers</span>
                                </div>
                            </div>
                            <div class="sign-up-row">
                                <div class="sign-up-inner-row">
                                    <span id="passwordConfirmGood" class="good-text" style="display: none;">OK</span>
                                    <span id="passwordConfirmError" class="required-text error" style="display: none;"></span>
                                    <span id="passwordConfirmText">Confirm Password</span>
                                </div>
                                <div>
                                    <input name="passwordConfirm" id="passwordConfirm" class="text-box text-box-large" tabindex="8" type="password" onkeyup="Roblox.AnimatedSignupFormValidator.checkPasswordConfirm();" />
                                </div>
                            </div>
			    <div class="sign-up-row">
                                <div class="h-captcha" data-sitekey="e36ad4e6-536c-4f1a-baba-d2cc9804c9de"></div>
                            </div>
                            

                                                        <div>
                                <a  onclick="return Roblox.AnimatedSignupFormValidator.validateForm();" tabindex="11" class="btn-large btn-primary roblox-signup" id="SignUpButton">Sign Up</a>
                            </div>
                        </form>
                    </div>
                    <script type="text/javascript"> 
                        if (typeof Roblox === "undefined") {
                            Roblox = {};
                        }

                        $(".roblox-signup").click(function() {
                            if(Roblox.AnimatedSignupFormValidator.validateForm())
                            {
                                $('#signup-form').submit();
                            }
                        });
        
                        $("#lstMonths").val();
                        $("#lstDays").val();
                        $("#lstYears").val();
        
;
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
 <div ID="AdWordConversionTracker" runat="server">
   <!-- Google Code for General Remarketing Remarketing List --> 
   <script type="text/javascript">
       var google_conversion_id = 1065449093;
       var google_conversion_language = "en";
       var google_conversion_format = "3";
       var google_conversion_color = "666666";
       var google_conversion_label = "A-sJCLfZnQIQhe2F_AM";
       var google_conversion_value = 0; 
    </script> 
    <script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"> </script> 
    <noscript> 
        <div style="display:inline;"> <img height="1" width="1" style="border-style:none;display:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1065449093/?label=A-sJCLfZnQIQhe2F_AM&amp;guid=ON&amp;script=0"/> </div> 
    </noscript>
</div>
            </div>

    <div class="Footer Experimental">
        <div class="FooterContent">
            <p class="FooterParagraph">
                <a href="http://jobs.roblox.com" ref="landingsignup-jobs">Jobs</a> &nbsp;|&nbsp; <a href="http://blog.roblox.com" ref="landingsignup-blog">Blog</a> &nbsp;|&nbsp; <a href="/Info/Privacy.aspx" ref="landingsignup-privacy">Privacy Policy</a> &nbsp;|&nbsp; <a href="http://corp.roblox.com/parents" ref="landingsignup-parents">Parents</a> &nbsp;|&nbsp; <a href="/Help/Builderman.aspx" ref="landingsignup-help">Help</a>
            </p>
            <div class="FooterLegaleseContainer">
                <p class="Legalese">
    ROBLOX, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="http://corp.roblox.com/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2014. Patents pending.
    ROBLOX is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
</p>
            </div>
        </div>
    </div>
        </div> 
        

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


        

    <script type="text/javascript">function urchinTracker() {}</script>

        <script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true, 'internalEventListenerPixelEnabled': true});
    });
</script>
        
<script type='text/javascript' src='http://js.rbxcdn.com/cb1ec1a0a286c244299bc3bb8994a1b9.js'></script>
<script src="https://hcaptcha.com/1/api.js" async defer></script>
        
<script type='text/javascript' src='http://js.rbxcdn.com/d208b1311ce3085f5824e4de9046878e.js'></script>

            <img src="https://secure.adnxs.com/seg?add=550800&t=2" width="1" height="1" style="display:none;"/>

        <script type="text/javascript">
            $(function () {
                $('.tooltip').tipsy();
                $('.tooltip-top').tipsy({ gravity: 's' });
                $('.tooltip-right').tipsy({ gravity: 'w' });
                $('.tooltip-left').tipsy({ gravity: 'e' });
                $('.tooltip-bottom').tipsy({ gravity: 'n' });
            });
        </script>
    </body>
</html>
