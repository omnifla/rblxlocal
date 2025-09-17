<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeaderMobile;
$user = Auth::GetAuthenticatedUserInfo();
?>

<html class="ui-mobile" style="--wm-toolbar-height: 1px;">
<head>
    <title>ROBLOX - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/Images/Icon114x114v3.png">
    <link rel="stylesheet" href="https://www.<?= $site_properties['hostname'] ?>/web/20150312214338cs_/https://m.roblox.com/CSS/Base/CSS/FetchCSS?path=page___c1f266fd667554c60776af47cca6a8ab_m.css">
    <script type="text/javascript" src="//web.archive.org/web/20150312214338js_/https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="//web.archive.org/web/20150312214338js_/https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
    <script type="text/javascript" src="https://web.archive.org/web/20150312214338js_/https://s3.amazonaws.com/js.roblox.com/ba00b3edd1e67e9348a47a67a08fa69e.js"></script>
    <script type="text/javascript" src="https://web.archive.org/web/20150312214338js_/http://cdn.gigya.com/js/gigya.js?apiKey=3_OsvmtBbTg6S_EUbwTPtbbmoihFY5ON6v6hbVrTbuqpBs7SyF_LQaJwtwKJ60sY1p"></script>
    <script async="" type="text/javascript" charset="UTF-8" src="https://web.archive.org/web/20150312214338js_/http://gscounters.us1.gigya.com/gscounters.sendReport?reports=%5B%7B%22name%22%3A%22loadc%22%2C%22time%22%3A%221426196622635%22%2C%22reportData%22%3A%7B%22sref%22%3A%22%22%7D%7D%5D&amp;APIKey=3_OsvmtBbTg6S_EUbwTPtbbmoihFY5ON6v6hbVrTbuqpBs7SyF_LQaJwtwKJ60sY1p&amp;sdk=js_5.3.4&amp;format=jsonp&amp;callback=gigya._.apiAdapters.web.callback&amp;context=R2626142621"></script>
</head>

<body data-ga-key="UA-486632-9" data-ga-devicename="Unknown" class="ui-mobile-viewport ui-overlay-c">
    <div id="login-page" data-role="page" data-url="login-page" tabindex="0" class="ui-page ui-body-c ui-page-active" style="min-height: 809px; width: 100%; height: auto;">
        <div class="wrapper" style="width: 100%;">
            <div data-role="header" data-id="header" class="ui-header ui-bar-a" role="banner">
                <div class="header-icons header-icons-left">
                    <a href="#" data-show-menu-link="" class="header-icons-menu ui-link"></a>
                </div>
                <h1 class="header-logo-only ui-title" role="heading" aria-level="1"></h1>
            </div>
            <div data-role="content" class="ui-content" role="main">


                <form action="/web/20150312214338/https://m.roblox.com/login" data-ajax="false" id="LogOnForm" method="post" novalidate="novalidate">
                    <p>
                        Log in to ROBLOX mobile to keep in touch with your friends.
                    </p>
                    <hr>
                    <div id="CredentialsSection">
                        <input data-val="true" data-val-required="The User name field is required." id="UserName" name="UserName" placeholder="Username" type="text" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">
                        <input data-val="true" data-val-required="The Password field is required." id="Password" name="Password" placeholder="Password" type="password" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">

                        <div class="ui-grid-a no-margin-grid">
                            <div class="ui-block-a">
                                <div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="null" data-iconpos="null" data-theme="b" data-inline="false" data-mini="false" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-fullsize ui-btn-block ui-submit"
                                aria-disabled="false"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">
                    Log In
                </span></span>
                                    <button type="submit" id="LogInButton" data-theme="b" data-use-sign-on-api="False" data-sign-on-api-path="https://api.roblox.com/login/v1" class="ui-btn-hidden" aria-disabled="false">
                                        Log In
                                    </button>
                                </div>
                            </div>
                            <div class="ui-block-b">
                                <a data-role="button" data-theme="f" data-ajax="false" href="/web/20150312214338/https://m.roblox.com/Account/SignUp" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-up-f"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">Sign Up</span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="TwoStepVerificationSection" style="display:none" data-request-code-unauthenticated-path="https://api.roblox.com/twostepverification/request-unauthenticated" data-verify-code-unauthenticated-path="https://api.roblox.com/twostepverification/verify-unauthenticated">
                        <div id="TwoStepVerificatonMessage">Enter your two step verification code.</div>
                        <input id="IdentificationCode" name="IdentificationCode" placeholder="Code" type="text" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset">

                        <div class="ui-grid-a no-margin-grid">
                            <div class="ui-block-a" id="SubmitCodeButtonBlock">
                                <div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="null" data-iconpos="null" data-theme="b" data-inline="false" data-mini="false" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-fullsize ui-btn-block"
                                aria-disabled="false"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">
                    Submit
                </span></span>
                                    <button id="SubmitCodeButton" data-theme="b" class="ui-btn-hidden" aria-disabled="false">
                                        Submit
                                    </button>
                                </div>
                            </div>
                            <div class="ui-block-a" id="GenerateNewCodeButtonBlock" style="display:none">
                                <div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="null" data-iconpos="null" data-theme="b" data-inline="false" data-mini="false" class="ui-btn ui-btn-up-b ui-shadow ui-btn-corner-all ui-fullsize ui-btn-block"
                                aria-disabled="false"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">
                    New Code
                </span></span>
                                    <button id="GenerateNewCodeButton" data-theme="b" class="ui-btn-hidden" aria-disabled="false">
                                        New Code
                                    </button>
                                </div>
                            </div>
                            <div class="ui-block-b" id="CancelCodeButtonBlock">
                                <div data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-icon="null" data-iconpos="null" data-theme="f" data-inline="false" data-mini="false" class="ui-btn ui-btn-up-f ui-shadow ui-btn-corner-all ui-fullsize ui-btn-block"
                                aria-disabled="false"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">
                    Cancel
                </span></span>
                                    <button id="CancelCodeButton" data-theme="f" class="ui-btn-hidden" aria-disabled="false">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <p style="text-align: center;">
                    <a data-rel="external" href="https://web.archive.org/web/20150312214338/http://www.roblox.com/Default.aspx?mobile=false" class="ui-link">View Full Site</a>
                    <br>
                    <br>
                </p>
                <p style="text-align: center;">By clicking Log In, you agree to our <a href="https://web.archive.org/web/20150312214338/http://www.roblox.com/info/terms-of-service" class="ui-link">Terms of Service</a>, <a href="https://web.archive.org/web/20150312214338/http://www.roblox.com/info/eula.htm"
                    class="ui-link">Licensing Agreement</a>, and <a href="https://web.archive.org/web/20150312214338/http://www.roblox.com/Info/Privacy.aspx" class="ui-link">Privacy Policy</a>.</p>
            </div>
        </div>
    </div>

    <div id="menu" style="height: auto; display: none;">
        <ul class="menu-first">
            <li><a href="/web/20150312214338/https://m.roblox.com/login">Home</a></li>
        </ul>
        <h3>Explore</h3>
        <ul>
            <li><a href="https://web.archive.org/web/20150312214338/http://m.roblox.com/people">People</a></li>
            <li><a href="https://web.archive.org/web/20150312214338/http://m.roblox.com/my-groups">Groups</a></li>
            <li><a href="https://web.archive.org/web/20150312214338/http://m.roblox.com/catalog">Catalog</a></li>
        </ul>
        <h3>&nbsp;</h3>
        <ul>
            <li><a href="https://web.archive.org/web/20150312214338/http://www.roblox.com/Default.aspx?mobile=false">Full Site</a></li>
            <li><a href="https://web.archive.org/web/20150312214338/http://blog.roblox.com/">Blog</a></li>
            <li><a href="https://web.archive.org/web/20150312214338/http://www.roblox.com/info/terms-of-service">Terms of Service</a></li>
            <li><a href="https://web.archive.org/web/20150312214338/http://www.roblox.com/Info/Privacy.aspx">Privacy Policy</a></li>
            <li class="menu-footer">
                <p>ROBLOX © 2015</p>
            </li>
        </ul>
    </div>
    <div id="screen-cover" style="display: none; width: 743px; height: 810px;"></div>


    <div class="ui-loader ui-corner-all ui-body-a ui-loader-default"><span class="ui-icon ui-icon-loading"></span>
        <h1>loading</h1></div>
</body>

</html>
