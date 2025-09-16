<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeaderMobile;
$user = Auth::GetAuthenticatedUserInfo();
?>

<!DOCTYPE html>
<html>
    <head>
                <title>RBLX.local - Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" /> 
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/Images/Icon114x114v3.png">

<link rel='stylesheet' href='https://<?= $site_properties['hostname'] ?>/CSS/Base/CSS/FetchCSS?path=page___e58fe365ff1540cd0ddc28d38aa70cdb_m.css' />
        <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
<script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/5ea8ef99bf4e445bb7e993c2d5d18fe5.js'></script>

        
    </head>
    <body data-ga-key="UA-486632-9" data-ga-devicename="Unknown">
        <div id="login-page" data-role="page" >
                <div class="wrapper">
                    <?= SiteHeaderMobile::render() ?>
                    <div data-role="content">
                        

<form action="/login" data-ajax="false" id="LogOnForm" method="post">    <p>
        Log in to RBLX.local mobile to keep in touch with your friends.
    </p>
    <hr />
    <div id="CredentialsSection">
        <input data-val="true" data-val-required="The User name field is required." id="UserName" name="UserName" placeholder="Username" type="text" value="" />
        <input data-val="true" data-val-required="The Password field is required." id="Password" name="Password" placeholder="Password" type="password" />

        <div class="ui-grid-a no-margin-grid">
            <div class="ui-block-a">
                <button type="submit" id="LogInButton"
                        data-theme="b"
                        data-use-sign-on-api="False"
                        data-sign-on-api-path="https://api.<?= $site_properties['hostname'] ?>/login/v1">
                    Log In
                </button>
            </div>
            <div class="ui-block-b">
                <a data-role="button" data-theme="f" data-ajax="false" href="/Account/SignUp">Sign Up</a>
            </div>
        </div>
    </div>
    <div id="TwoStepVerificationSection" style="display:none"
         data-request-code-unauthenticated-path="https://api.<?= $site_properties['hostname'] ?>/twostepverification/request-unauthenticated"
         data-verify-code-unauthenticated-path="https://api.<?= $site_properties['hostname'] ?>/twostepverification/verify-unauthenticated">
        <div id="TwoStepVerificatonMessage">Enter your two step verification code.</div>
        <input id="IdentificationCode" name="IdentificationCode" placeholder="Code" type="text" value="" />

        <div class="ui-grid-a no-margin-grid">
            <div class="ui-block-a" id="SubmitCodeButtonBlock">
                <button id="SubmitCodeButton"
                        data-theme="b">
                    Submit
                </button>
            </div>
            <div class="ui-block-a" id="GenerateNewCodeButtonBlock" style="display:none">
                <button id="GenerateNewCodeButton"
                        data-theme="b">
                    New Code
                </button>
            </div>
            <div class="ui-block-b" id="CancelCodeButtonBlock">
                <button id="CancelCodeButton"
                        data-theme="f">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</form>
<p style="text-align: center;">
    <a data-rel="external" href="http://www.<?= $site_properties['hostname'] ?>/Default.aspx?mobile=false">View Full Site</a><br/><br/>
</p>
<p style="text-align: center;">By clicking Log In, you agree to our <a href="http://www.<?= $site_properties['hostname'] ?>/info/terms-of-service">Terms of Service</a>, <a href="http://www.<?= $site_properties['hostname'] ?>/info/eula.htm">Licensing Agreement</a>, and <a href="http://www.<?= $site_properties['hostname'] ?>/Info/Privacy.aspx">Privacy Policy</a>.</p>
                    </div>
                </div>
        </div>

            <div id="menu">
                                    <ul class="menu-first"> <li><a data-ajax='false' href="/login">Home</a></li> </ul>                  <h3>Explore</h3>
                <ul>
                     <li><a  href="http://m.roblox.com/people">People</a></li> 
                     <li><a  href="http://m.roblox.com/my-groups">Groups</a></li> 
                     <li><a  href="http://m.roblox.com/catalog">Catalog</a></li> 
                </ul>
                <h3>&nbsp;</h3>
                <ul>
                     <li><a  href="http://www.roblox.com/Default.aspx?mobile=false">Full Site</a></li> 
                     <li><a  href="http://blog.roblox.com">Blog</a></li> 
                     <li><a  href="http://www.roblox.com/info/terms-of-service">Terms of Service</a></li> 
                     <li><a  href="http://www.roblox.com/Info/Privacy.aspx">Privacy Policy</a></li> 
                    <li class="menu-footer"><p>RBLX.local &copy; 2015</p></li>
                </ul>
            </div>
            <div id="screen-cover"></div>
        
<div id="downloadTheAppBar">
    <div>
        <img src="/Images/logo_R@2x.png" />
    </div>
    <div class="app-motto-container">
        <div class="app">Play games in our app</div>
        <br />
        <div class="motto">Hundreds of games by players like you</div>
    </div>
    <a rel="external" class="continue-in-app btn-medium-primary" href="/" data-backup-url="">Play</a>
</div>    </body>
</html>
