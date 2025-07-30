<?php
// written by denied_id
include_once $_SERVER["DOCUMENT_ROOT"] . "/../config/main.php";
use Roblox\Authentication as Auth;
use Roblox\Web\SiteHeader;
use Roblox\Web\SiteFooter;
use Roblox\Web\SiteAlert;
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" style="--wm-toolbar-height: 67px;">
<head>
    <?= $site_properties['Title'] ?>.com
    <script type="text/javascript" src="/js/roblox.js"></script>
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___3f022c119bae81d03158987f73441ea8_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=reset___90041b2af2fb6b9b7864ee66001ba812_m.css"> 
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___7784dd6e42c72aa68f642d792c3f9f15_m.css">
</head>

<body><div id="fb-root"></div>


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
                        $(function() {
                            function trackReturns() {
                                function dayDiff(d1, d2) {
                                    return Math.floor((d1-d2)/86400000);
                                }

                                var cookieName = 'RBXReturn';
                                var cookieOptions = {
                                    expires: 9001
                                };
                                var cookie = $.getJSONCookie(cookieName);

                                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                                    $.setJSONCookie(cookieName, {
                                        ts: new Date().toDateString()
                                    }, cookieOptions);
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

                                $.setJSONCookie(cookieName, cookie, cookieOptions);
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

                    <div>
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


                        </script>
                        <style>
                            html {
                                background: #123f83;
                            }
                        </style>
                        <div class="forceSpace">
                            &nbsp;
                        </div>
                        <noscript><div class="SystemAlert">
                            <div class="SystemAlertText">
                                Please enable Javascript to use all the features on this site.
                            </div>
                        </div>
                        </noscript>
                        <?= SiteHeader::render() ?>
                        <?= SiteAlert::render() ?>
                        <div id="BodyWrapper">
                            <div id="RepositionBody">
                                <div id="Body" style="width:970px">
                                    <div style="width:100%;">
                                        <div style="margin-left:5px;">
                                            <h1 style="padding:0;">Buy ROBUX</h1>
                                            <div>
                                                <img width="48px" height="48px" alt="R$" src="https://web.archive.org/web/20140207123900im_/https://s3.amazonaws.com/images.roblox.com/72019d3cb1b2c8e1660b03b7423124c7.png" style="float:left;">
                                                <div class="rdar-text">
                                                    Use ROBUX to buy virtual goods for your character - shirts, pants, hats, faces, and even heads!
                                                    <br>
                                                    You can also buy gear, like hammers, potions, jet boots, swords, and BLOXI Cola.
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                        <div class="robux-products-container">
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=42" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        400 Robux $4.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 450 ROBUX for $4.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    400
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=45" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        800 Robux $9.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 1000 ROBUX for $9.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    800
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=10" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        2000 ROBUX $24.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 2750 ROBUX for $24.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    2000
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=46" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        4500 ROBUX $49.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 6000 ROBUX for $49.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    4500
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=19" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        10000 ROBUX $99.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 15000 ROBUX for $99.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    10000
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="bottom-40">
                                                <div class="robux-product-body">
                                                    <a href="/web/20140207123900/https://www.roblox.com/Upgrades/PaymentMethods.aspx?ap=21" class="btn-small btn-primary robux-buy">Buy</a>
                                                    <div class="robux-membership">
                                                        Standard Member
                                                    </div>
                                                    <h3>
                                                        22500 ROBUX $199.95
                                                    </h3>
                                                    <div class="divider-bottom"></div>
                                                    <div style="font-size: 11px;">
                                                        Builder's Club Members get 35000 ROBUX for $199.95  <a href="/web/20140207123900/https://www.roblox.com/Upgrades/BuildersClubMemberships.aspx"> Upgrade Now!</a>
                                                    </div>
                                                </div>
                                                <div class="robux-title">
                                                    22500
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div style="font-size: 10px;">
                                                Prices for Turbo and Outrageous Builder's Club are the same as for regular Builder's Club. All sales are final. Please see our <a href="/web/20140207123900/https://www.roblox.com/info/terms-of-service">Terms &amp; Conditions</a> for more information.
                                            </div>

                                        </div>
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

</body></html>
