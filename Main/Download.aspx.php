<?php
// written by denied_id (optimized by exrand)
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteAlert;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($site_properties["Title"], ENT_QUOTES, 'UTF-8') ?>.com</title>
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css" />
    <style>
        html { background: #123f83; }
    </style>
</head>

<body class="unfixed">
    <div class="no-gutter-ads">
        <div id="MasterContainer">
            <div class="forceSpace">&nbsp;</div>

            <?= SiteHeader::render() ?>

            <div class="site-header">
                <div id="navigation-container">
                    <a href="/Default.aspx" class="btn-logo"></a>
                </div>
            </div>

            <div class="forceSpace">&nbsp;</div>

            <noscript>
                <div class="SystemAlert">
                    <div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div>
                </div>
            </noscript>

            <?= SiteAlert::render() ?>

            <div id="BodyWrapper">
                <div id="RepositionBody">
                    <div id="Body" style="simple-body">
                        <div id="ErrorPage">
                            <img src="https://web.archive.org/web/20140502165338im_/http://images.rbxcdn.com/44bf8b61b3c2d5f76837b2209dfb99b0.png" 
                                 alt="Alert" class="ErrorAlert">

                            <h1>Note for the Developers.</h1>
                            <h3>I've tried searching for a restored version of this page back in 2014.</h3>
                            <p>Every link on web.archive.org just left me with a blank page.</p>

                            <div class="divideTitleAndBackButtons">&nbsp;</div>

                            <p>If you're just a normal user, you can ignore this message.<br>
                            Just try to download the client via pressing play on a game instead from the 
                            <a href="/games">games</a> page.</p>

                            <pre><span id="ctl00_cphRoblox_errorMsgLbl"></span></pre>

                            <div class="divideTitleAndBackButtons">&nbsp;</div>

                            <div class="CenterNavigationButtonsForFloat">
                                <a class="btn-neutral btn-small" 
                                   title="Go to Previous Page Button" 
                                   onclick="history.back();return false;" href="#">
                                   Go to Previous Page<span class="btn-text"> Go to Previous Page</span>
                                </a>
                                <a class="btn-neutral btn-small" title="Return Home" href="/Default.aspx">
                                   Return Home <span class="btn-text">Return Home</span>
                                </a>
                                <div style="clear:both"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <?= SiteFooter::render() ?>
        </div>
    </div>
</body>
</html>
