<?php
// written by denied_id
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";

use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" id="www-roblox-com">

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <title>
        <?= $site_properties["Title"] ?>.com
    </title>

    <head id="ctl00_Head1">
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css' />
</head>

<body class="unfixed">
    <div class=" no-gutter-ads">
        <div class="">
            <div class="">
                <div id="MasterContainer">
                    <div class="forceSpace">&nbsp;</div>
                    <div>
                        <?= SiteHeader::render() ?>

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
                                    <h2>This page intentionally left blank.</h2>

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