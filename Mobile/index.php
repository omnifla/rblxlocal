<?php
// reutilized from index.php on the main site
// Used as a homepage
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeaderMobile;
header("Content-Security-Policy: upgrade-insecure-requests");
if (!Auth::GetAuthenticatedUser()) {
    header("Location: /login", true, 302);
    exit;
}
$user = Auth::GetAuthenticatedUserInfo();
?>
<!DOCTYPE html>
<html>
    <head>
                <title>RBLX.local</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" /> 
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/Images/Icon114x114v3.png">

<link rel='stylesheet' href='https://www.<?= $site_properties['hostname'] ?>/CSS/Base/CSS/FetchCSS?path=page___c1f266fd667554c60776af47cca6a8ab_m.css' />
        <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
<script type='text/javascript' src='https://s3.amazonaws.com/js.roblox.com/ba00b3edd1e67e9348a47a67a08fa69e.js'></script>
    <script type="text/javascript" src="http://cdn.gigya.com/js/gigya.js?apiKey=3_OsvmtBbTg6S_EUbwTPtbbmoihFY5ON6v6hbVrTbuqpBs7SyF_LQaJwtwKJ60sY1p"></script>

        
    </head>
    <body data-ga-key="UA-486632-9" data-ga-devicename="Unknown">
        <div id="login-page" data-role="page" >
                <div class="wrapper">
                    <?= SiteHeaderMobile::render() ?>
                                            </div>                                       
                    <div data-role="content">
<p>wip</p>
                    </div>
                </div>
        </div>
        
            <div id="menu">
                                    <ul class="menu-first"> <li><a  href="/login">Home</a></li> </ul>                  <h3>Explore</h3>
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
                    <li class="menu-footer"><p>ROBLOX &copy; 2015</p></li>
                </ul>
            </div>
            <div id="screen-cover"></div>
    </body>
</html>
