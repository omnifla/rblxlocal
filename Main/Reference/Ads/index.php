<?php
// written by denied_id
include_once $_SERVER['DOCUMENT_ROOT'].'/../config/main.php';

use Roblox\Authentication as Auth;
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteAlert;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <title>
        <?= $site_properties["Title"] ?>.com
    </title>

    <script type="text/javascript" src="/js/roblox.js"></script>
    <script type="text/javascript" src="/JS/Modules/Widgets/DropdownMenu.js"></script>
    <script type="text/javascript" src="/js/jquery/jquery-1.7.2.min.js"></script>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css' />
</head>

<body class="">
    <div id="fb-root"></div>

    <div class=" no-gutter-ads">
        <div class="">
            <div class="">
                <div id="MasterContainer">
                    <div>
                        <?= SiteHeader::render() ?>
                        <?= SiteAlert::render() ?>
                        <style>
                            html {
                                background: #123f83;
                            }
                        </style>
                        <div class="forceSpace">&nbsp;</div>
                        <noscript>
                            <div class="SystemAlert">
                                <div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div>
                            </div>
                        </noscript>
                        <div id="BodyWrapper">
                            <div id="RepositionBody">
                                <div id="Body" style="width:970px">
                                    <div id="GPTAd" class="GPTAd">
                                        <div style="width: 728px">
                                            <span id="3234353631353333" class="GPTAd banner" data-js-adtype="gptAd">
                                                <script type="text/javascript">
                                                    googletag.cmd.push(function() {
                                                        googletag.display("3234353631353333");
                                                    });
                                                </script>
                                            </span>
                                            <div class="ad-annotations " style="width: 728px">
                                                <span class="ad-identification">Advertisement
                                                    <span> - </span>
                                                    <a href="" class="UpsellAdButton" title="Click to learn how to remove ads!">Why am I seeing ads?</a>
                                                </span>
                                                <a class="BadAdButton" href="/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="InHouseAd" class="InHouseAd">
                                        <div style="width: 728px">
                                            <span id="3332353135323230" class="GPTAd banner" data-js-adtype="gptAd">
                                                <script type="text/javascript">
                                                    googletag.cmd.push(function() {
                                                        googletag.display("3332353135323230");
                                                    });
                                                </script>
                                            </span>
                                            <div class="ad-annotations " style="width: 728px">
                                                <span class="ad-identification">Advertisement
                                                </span>
                                                <a class="BadAdButton" href="/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="UserAd" class="UserAd">
                                        <iframe allowtransparency="true" frameborder="0" height="110" scrolling="no" src="/userads/1" width="728" data-js-adtype="iframead" data-ruffle-polyfilled=""></iframe>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>
                        <?= SiteFooter::render() ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
