<?php
// random 2025
// the INDEX... 
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
header("Content-Security-Policy: upgrade-insecure-requests");
$returnUrl = $_GET['ReturnUrl'] ?? '/Home/';

if(Auth::GetAuthenticatedUser()){
    header("Location: " . urldecode($returnUrl));
    exit;
}
?>


<!DOCTYPE html>
<!--[if IE 8]><html class="ie8" ng-app="robloxApp"><![endif]-->
<!--[if gt IE 8]><!-->
<html>
<!--<![endif]-->
<head>
    <!-- MachineID: WEB338 -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <meta name="author" content="ROBLOX Corporation" />
    <meta name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." />
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
    <meta name="apple-itunes-app" content="app-id=431946152" />

    <title><?= $site_properties['hostname'] ?></title>
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />

    
    <link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700' rel='stylesheet' type='text/css'>

    
    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=leanbase___71f465fc3508bdea4bb0caae519e9836_m.css' />

    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___87d690102e690d673871bd2c937b165d_m.css' />

    
    
    
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>


    
    <script type='text/javascript' src='http://js.rbxcdn.com/35442da4b07e6a0ed6b085424d1a52cb.js'></script>


    
    

    
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

    <div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer)\.roblox\.com|robloxlabs\.com)((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))" data-regex-flags="gm"></div>
   
    
    
        <script type="text/javascript">
        $(function() {
            if (Roblox.EventStream) {
                Roblox.EventStream.InitializeEventStream(null, 5, "http://public.ecs.<?= $site_properties['hostname'] ?>/www/e.png");
            }
        });
    </script>

</head>
<body>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>    
    


<style type="text/css">
    .coverSprite {
        background-repeat: no-repeat;
        background-image: url('http://images.rbxcdn.com/20e7d1543d2c5caf201184d86530fc35.png');
    }

    #RollerContainer {
        background-image: url('http://images.rbxcdn.com/dcbdfaf1c08058e71f65c09f7b98ff04.jpg');
        background-repeat: no-repeat;
        background-size: cover;
    }

    .special-dropdown select {
        border: 0 !important;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: url('http://images.rbxcdn.com/379f4f1018f31cbb62ef52a22d9f2118.png') no-repeat;
        background-position: 92% 40%;
        width: 100px;
        text-indent: 0.01px;
        text-overflow: "";
    }
    #InnerWhatsRobloxContainer1 {
        height: 70%;
        background-image: url('http://images.rbxcdn.com/cca69eca62f23ca413fc920549e936ea.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 30% center;
        color: white;
    }
    #GameImage1 {
        background-image: url('http://images.rbxcdn.com/42268b6264d89827401ef912f174f288.jpg');
        margin-right: 5px;
    }

    #GameImage2 {
        background-image: url('http://images.rbxcdn.com/04baeb33ef66ef1395cd5464309fece6.jpg');
        margin-right: 5px;
    }

    #GameImage3 {
        background-image: url('http://images.rbxcdn.com/e8b89d14690203420d64b5b2fda0b461.jpg');
        margin-right: -10px;
        width: calc(33.333333% - 10px);
    }
</style>
<div class="navbar navbar-landing navbar-fixed-top" role="navigation" ng-modules="robloxApp, LandingSignup">
    <div class="container">
        <div class="row">
            <div class="navbar-header col-md-6">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#LandingNavbar">
                    Log In
                </button>
                <div class="navbar-brand hidden-xs"><img class="robloxLogo" src="http://images.rbxcdn.com/10722000cfdcfe1f5b447d83e6d6c761.png" /></div>
                <ul id="TopLeftNavLinks" class="nav navbar-nav">
                    <li id="PlayLink" class="pull-left"><a href="#RollerContainer" onclick="return scrollTo(1, '#RollerContainer');">Play</a></li>
                    <li id="AboutLink" class="pull-left"><a href="#WhatsRobloxContainer" onclick="return scrollTo(2, '#WhatsRobloxContainer');">About</a></li>
                    <li id="PlatformLink" class="pull-left"><a href="#RobloxDeviceText" onclick="return scrollTo(3, '#RobloxDeviceText');">Platforms</a></li>
                    <li id="magic-line"></li>
                </ul>
            </div>

            <div class="collapse navbar-collapse col-sm-6" id="LandingNavbar" ng-controller="LoginController">
                <form name="loginForm" action="https://<?= $site_properties['hostname'] ?>/newlogin" id="LogInForm" class="navbar-form form-inline navbar-right" ng-submit="submitLogin($event)" method="post" role="form" data-use-apiproxy-signin="False" data-sign-on-api-path="https://api.<?= $site_properties['hostname'] ?>/login/v1" novalidate>
                    <div class="form-group" ng-class="{ 'has-error': loginForm.username.$invalid && badSubmit}">
                        <input id="LoginUsername" type="text" placeholder="Username" class="form-control" name="username" ng-required="true" ng-model="login.username" />
                    </div>
                    <div class="form-group" ng-class="{ 'has-error': loginForm.password.$invalid && badSubmit}">
                        <input id="LoginPassword" type="password" placeholder="Password" class="form-control" name="password" ng-required="true" ng-model="login.password" required />
                    </div>
                    <div class="form-group">
                        <input type="submit" id="LoginButton" class="form-control" value="Log In" />
                    </div>
                    <a id="HeaderForgotPassword" class="navbar-link" href="/Login/ResetPasswordRequest.aspx">Forgot Username/Password?</a>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" ng-modules="robloxApp, LandingSignup">
    <!-- Roller Coaster-->
    <section class="row full-height-section" id="RollerContainer">
        <div class="col-md-12 inner-full-height-section" id="InnerRollerContainer">
            <div id="MainCenterContainer" class="row">
                <div class="col-xs-12 col-md-6">
                    <div id="MainLogo" class="text-right">
                        <div id="LogoAndSlogan" class="text-center">
                            <img id="MainLogoImage" title="ROBLOX" class="center-block img-responsive" src="http://images.rbxcdn.com/f76c76889f4b167ca1f27edc27eb8146.png" />
                            <div class="clearfix"></div>
                            <h1>You Make the Game<span> &#8482 </span></h1>
                        </div>
                    </div>
                </div>
                
                

<!-- Modal -->
<div id="BootstrapConfirmationModal" data-modal-handle="bootstrap-confirmation" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="roblox-close-btn" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays data-no-click>
                    <img class="GenericModalImage" alt="generic image" />
                </div>
                <p class="modal-body-text"></p>
                <p id="roblox-captcha-error" class="text-center text-danger"></p>
            </div>
            <div class="modal-footer">
                <button type="button" id="roblox-decline-btn" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="roblox-confirm-btn" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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

                <div class="clearfix visible-sm"></div>
                <div class="col-xs-12 col-md-6">
                    <div id="SignUpFormContainer" class="" ng-controller="SignUpController">
                        <form action="https://<?= $site_properties['hostname'] ?>/landing/signup" name="signupForm" id="SignUpForm" method="post" role="form" ng-submit="submitSignup($event)" novalidate autocomplete="off">
                            <input name="__RequestVerificationToken" type="hidden" value="sgM4VPqFu_Uh2l0W2Et9l2RvB2qTAscwkfinmoXZvM_y7L70h-ZXdZR-peoRmKanNjodzwjZvCZ3boAiBXAGibi9B1Y1" />
                            <h3 class="text-left">Sign up and start having fun!</h3>
                            <div class="form-group" ng-class="{ 'has-error': (badSubmit && signupForm.userName.$invalid) || signupForm.userName.$showError, 'has-success': signupForm.userName.$showSuccess  }">
                                <input id="SignupUsername" ng-model="signup.username" type="text" name="userName" class="form-control input-lg" placeholder="Username (3-20 characters, no spaces)" ng-maxlength="20" maxlength="20" ng-required="true" rbx-valid-username rbx-show-error autocomplete="off" autofocus="autofocus" data-last-username="" />
                                <div id="UsernameError" class="text-danger" ng-cloak ng-show="signupForm.userName.$showError" ng-bind="signupForm.userName.$usernameMessage"></div>
                            </div>
                            <div class="form-group" ng-class="{ 'has-error': (badSubmit && signupForm.password.$invalid) || signupForm.password.$showError, 'has-success': signupForm.password.$showSuccess  }">
                                <input id="SignupPassword" ng-model="signup.password" type="password" name="password" class="form-control input-lg" placeholder="Password (4 letters and 2 numbers minimum)" ng-required="true" autocomplete="off" rbx-show-error rbx-valid-password data-last-password="" />
                                <div id="PasswordError" class="text-danger" ng-cloak ng-show="signupForm.password.$showError" ng-bind="signupForm.password.$passwordMessage"></div>
                            </div>
                            <div class="form-group" ng-class="{ 'has-error': (badSubmit && signupForm.passwordConfirm.$invalid) || signupForm.passwordConfirm.$showError, 'has-success': signupForm.passwordConfirm.$showSuccess  }">
                                <input id="SignupPasswordConfirm" ng-model="signup.passwordConfirm" type="password" name="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" ng-required="true" match="signup.password" autocomplete="off" rbx-show-error rbx-valid-password-confirm data-last-password="" />
                                <div id="PasswordConfirmError" class="text-danger" ng-cloak ng-show="signupForm.passwordConfirm.$showError" ng-bind="signupForm.passwordConfirm.$passwordConfirmMessage"></div>
                            </div>
                            <div class="form-group" ng-class="{'has-error': badSubmit && !validBirthday(), 'has-success':validBirthday()}">
                                <div class="form-control fake-input-lg form-inline">
                                    <label>Birthday</label>
                                    <input name="lstMonths" ng-value="submitMonth()" type="hidden" />
                                    <input name="lstDays" ng-value="signup.birthdayDay" type="hidden" />
                                    <input name="lstYears" ng-value="signup.birthdayYear" type="hidden" />
                                    <div class="special-dropdown month-special-dropdown">
                                        <select id="birthdayMonthSelect" ng-model="signup.birthdayMonth" ng-required="true" autocomplete="off" data-last-selected="">
                                            <option value="">Month</option>
                                            <option value="0">January</option>
                                            <option value="1">February</option>
                                            <option value="2">March</option>
                                            <option value="3">April</option>
                                            <option value="4">May</option>
                                            <option value="5">June</option>
                                            <option value="6">July</option>
                                            <option value="7">August</option>
                                            <option value="8">September</option>
                                            <option value="9">October</option>
                                            <option value="10">November</option>
                                            <option value="11">December</option>
                                        </select>
                                    </div>
                                    <div class="special-dropdown day-special-dropdown">
                                        <select id="birthdayDaySelect" ng-model="signup.birthdayDay" ng-options="day for day in days" ng-required="true" autocomplete="off" data-last-selected="">
                                            <option value="">Day</option>
                                        </select>
                                    </div>
                                    <div class="special-dropdown year-special-dropdown">
                                        <select id="birthdayYearSelect" ng-model="signup.birthdayYear" ng-options="year for year in years" ng-required="true" autocomplete="off" data-last-selected="">
                                            <option value="">Year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" ng-class="{'has-error': badSubmit && !validGender(), 'has-success':validGender()}">
                                <div class="form-control fake-input-lg">
                                    <input type="hidden" id="GenderInput" name="gender" ng-value="signup.gender" data-last-gender-male="False" data-last-gender-female="False" />
                                    <div class="pull-left"><label>Gender:</label></div>
                                    <div title="Female" class="gender-circle" tabindex="0" ng-class="{'selected-gender': signup.gender === 'female'}" ng-click="selectFemale()">
                                        <div class="coverSprite gender female"></div>
                                    </div>
                                    <div title="Male" class="gender-circle" tabindex="0" ng-class="{'selected-gender': signup.gender === 'male'}" ng-click="selectMale()">
                                        <div class="coverSprite gender male"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <input id="SignUpButton" type="submit" class="form-control input-lg submit sign-up-button" value="Sign Up" disabled ng-disabled="submitButtonDisabled">
                            </div>
                            <noscript>
                                <div class="text-danger">
                                    <strong>JavaScript is required to submit this form.</strong>
                                </div>
                            </noscript>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="attribution hidden-xs">
            <span class="notranslate">Game: ROBLOX Point</span><br>
            Developer: <span class="notranslate">StarMarine614</span>
        </div>
    </section>

    <!-- What is Roblox -->
    <section class="row full-height-section" id="WhatsRobloxContainer">

        <div class="col-md-12 inner-full-height-section">

            <div class="row" id="InnerWhatsRobloxContainer1">
                <div id="WhatIsRobloxTextBg" class="col-sm-5 col-sm-offset-6 col-xs-8 col-xs-offset-2">
                    <h1 class="text-center">What is ROBLOX?</h1>
                    <p class="lead text-justify">ROBLOX is the Game Powered by Players. Build your own game world and bring it to life, publish and share it, experience what others have created, play with friends. ROBLOX is the leader in user-generated creation and gaming for all ages. What will you build?</p>
                </div>
            </div>

            <div class="row" id="InnerWhatsRobloxContainer2">
                <div id="GameImage1" class="col-sm-4 col-xs-12 game-image"></div>
                <div id="GameImage2" class="hidden-xs col-sm-4 game-image"></div>
                <div id="GameImage3" class="col-sm-4 hidden-xs game-image"></div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>

    <!-- Roblox on your device -->
    <section id="DeviceSection">
        <div class="row" id="RobloxDeviceText">
            <div class="col-md-6 col-md-offset-3 text-center">
                <h2>ROBLOX on your device.</h2>
                <p class="lead center-block">Play ROBLOX on your desktop, your tablet, or your phone. Access your account, games, and inventory; connect with your friends; and play games whether you're at home or on the go.</p>
            </div>
        </div>

        <div id="AppStoreContainer" class="row text-center">
            <a href="https://itunes.apple.com/us/app/roblox-mobile/id431946152" target="_blank">
                <img class="app-store-logo" src="http://images.rbxcdn.com/9819a104fc46fb90d183387ba81065a0.png" title="ROBLOX on App Store" />
            </a>
            <a href="https://play.google.com/store/apps/details?id=com.roblox.client&hl=en" target="_blank">
                <img class="app-store-logo" src="http://images.rbxcdn.com/75ba3866ee59c113220b369c2432c7f9.png" title="ROBLOX on Google Play" />
            </a>
        </div>

        <div class="row" id="DeviceImageContainer">
            <div class="col-md-12">
                <div class="row text-center">
                    <img id="ComputerImgSmall" class="center-block img-responsive hidden-lg ComputerImg" src="http://images.rbxcdn.com/5ed7d6f37de88cc74c581d9a97fdcbb2.png" />
                    <img class="center-block img-responsive visible-lg-block ComputerImg" src="http://images.rbxcdn.com/6288b7c9683f37f50efef75a5e10f2ad.png" />

                </div>
            </div>
        </div>
    </section>

    <footer class="row">
        <div class="col-xs-12">
            <div id="FooterBigLinks" class="row">
                <div class="col-md-12 text-center">
                    <a href="//corp.<?= $site_properties['hostname'] ?>" target="_blank">About Us</a>
                    <a href="//corp.<?= $site_properties['hostname'] ?>/jobs" target="_blank">Jobs</a>
                    <a href="//blog.<?= $site_properties['hostname'] ?>" target="_blank">Blog</a>
                    <a href="/Info/Privacy.aspx" target="_blank">Privacy</a>
                    <a href="//corp.<?= $site_properties['hostname'] ?>/parents" target="_blank">Parents</a>
                    <a href="//en.help.<?= $site_properties['hostname'] ?>/" target="_blank">Help</a>
                </div>
            </div>
            <div class="row">
                <div id="FooterLegalText" class="col-xs-11 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-justify">
                    ROBLOX, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a target="_blank" href="//corp.<?= $site_properties['hostname'] ?>">ROBLOX Corporation</a>, ©2015. Patents pending. ROBLOX is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" target="_blank">Terms and Conditions</a>.
                </div>
            </div>
        </div>
    </footer>
</div>
 

<img src="/timg/rbx" />
<script>
    Roblox.Resources.AnimatedSignupFormValidator = {
        //<sl:translate>
        doesntMatch: "Passwords don't match",
        requiredField: "Required",
        tooLong: "Too long",
        tooShort: "Too short",
        maxValid: "Too many accounts use this email",
        needsFourLetters: "Needs 4 letters",
        needsTwoNumbers: "Needs 2 numbers",
        noSpaces: "No spaces allowed",
        weakKey: "Weak key combination.",
        invalidCharacters: "Spaces and special characters are not allowed in usernames.",
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
<script src="https://apis.google.com/js/platform.js"></script>

    
    <script type='text/javascript' src='http://js.rbxcdn.com/93a9c1615db9841bce7d67bdb087d3da.js'></script>


    
<script type='text/javascript' src='http://js.rbxcdn.com/8030e8e1027b814be8f4e744ba54f78c.js'></script>
    
    
    
    <script type='text/javascript'>Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/a2ff3787d1fd8d3c2492b5f5c5ec70b6.js';Roblox.config.paths['Pages.CatalogShared'] = 'http://js.rbxcdn.com/4eb48eec34ca711d5a7b08a4291ac753.js';Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/e8cbac58ab4f0d8d4c707700c9f97630.js';Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/bbaeb48f3312bad4626e00c90746ffc0.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/7b436bae917789c0b84f40fdebd25d97.js';Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/33d82b98045d49ec5a1f635d14cc7010.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/fbb86cf0752d23f389f983419d3085b4.js';Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/838ec9c8067ba6fd6793a8bdbdb48a5c.js';Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/f2697119678d0851cfaa6c2270a727ed.js';Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script>

    
    <script>
        Roblox.XsrfToken.setToken('L/ezQiOZf11g');
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
        $(function () {
            RobloxEventManager.triggerEvent('rbx_evt_newuser', {});
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

    
    <script type='text/javascript' src='http://js.rbxcdn.com/19afbd433dd652459d42fb238f694071.js'></script>

</body>
</html>