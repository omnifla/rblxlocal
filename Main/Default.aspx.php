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
        Free Games at <?= $site_properties["Title"] ?>.com
    </title>

    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___97cad0883768f57f1b3c21ecbc1579e1_m.css' />
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___0b49cffa7341e6b5590a55699d17e053_m.css" />
    
</head>

<body class="unfixed">
    <div class=" no-gutter-ads">
        <div class="">
            <div class="">
                <div id="MasterContainer" class="unfixed">
                    <script type="text/javascript">
                        Roblox.FixedUI.gutterAdsEnabled = false;
                    </script>

                    <div class="forceSpace unfixed">&nbsp;</div>
                    <div id="ctl00_cphBannerAd_topAdPanel">

                    </div>

                    <noscript>
                        <div class="SystemAlert">
                            <div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div>
                        </div>
                    </noscript>

                    <div id="BodyWrapper">
                        <?= SiteHeader::render() ?>
                        <div class="forceSpace">&nbsp;</div>
                        <div id="RepositionBody">
                            <div id="Body" style="width:970px;">
                                <script type="text/javascript">
                                    //Code for A|B|C test- just one/all goto burning ma
                                    switch (0) {
                                        case 0:
                                            break;
                                        case 1:
                                            $("#PlayNowButton").css('visibility', 'hidden');
                                            $(function() {
                                                $('.FeaturedGameHeader').css('visibility', 'hidden');
                                                $('.FeaturedGameHeader').css('height', '0px');
                                                $('.FeaturedGamePlayButton').css('height', '290px');
                                            });
                                            break;
                                        case 2:
                                            $('.SignUpAndPlay').attr('href', "");
                                            $('.SignUpAndPlay').click(function() {
                                                $('.VisitButtonPlay').click();
                                                return false;
                                            });
                                            $(function() {
                                                $('#ctl00_cphRoblox_MoneyMachine_PlayNowButton').attr('href', "");
                                                $('#ctl00_cphRoblox_MoneyMachine_PlayNowButton').click(function() {
                                                    $('.VisitButtonPlay').click();
                                                    return false;
                                                });
                                            });

                                            //set href of FeaturedGamesPlay to "burning man"s
                                            break;
                                    }
                                    //Code for bigPlayNowButtonLocation A|B test
                                    if (false) {
                                        $(function() {
                                            $('#ctl00_cphRoblox_rbxVisitButtons_FeaturedGameButton').attr('placeid', 1818);
                                            $('#FeaturedGameButton').attr('placeid', 1818);
                                        });
                                    }
                                    //else is already acting as needed
                                </script>


                                <div class="TopPanel" style="float: left; margin: 0px;position:relative;">
                                    <div id="ctl00_cphRoblox_FrontPageLogin" class="FrontPageLoginBox">
                                        <div id="LoginViewContainer">
                                            <script type="text/javascript" language="javascript">
                                                function dologin() {
                                                    document.getElementById("username").value = document.getElementById("txtUsername").value;
                                                    document.getElementById("password").value = document.getElementById("txtPassword").value;
                                                    document.forms[1].submit();
                                                }
                                            </script>

                                            <div class="DarkGradientBox">
                                                <div class="DGB_Header">Member Login</div>
                                                <div style="padding:0px;">
                                                    <div class="form-outer">
                                                        <div class="form-inner label-column">
                                                            <div for="txtUsername" class="DGB_Label" style="top:0px;margin-bottom:10px;">Username:</div>
                                                            <div for="txtPassword" class="DGB_Label passwordInput" style="*top:2px;">Password:</div>
                                                        </div>
                                                        <div class="form-inner input-column">
                                                            <input type="text" class="DGB_TextBox" id="txtUsername" tabindex="1" style="margin-bottom:10px;margin-right:0px;">
                                                            <input type="password" onkeypress="if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {dologin(); return false;} else {return true;}}" id="txtPassword" class="DGB_TextBox" style="margin-right:0px;" tabindex="2">
                                                            <span id="ForgetPasswordPrompt"><a href="/web/20140502164823/http://www.roblox.com/Login/ResetPasswordRequest.aspx">Forget your password?</a></span>
                                                            <div class="clear"></div>
                                                        </div>
                                                    </div>


                                                    <div style="margin-top: 9px; text-align: center;">
                                                        <a class="ControlLoginButton" onclick="dologin(); return false;" href="#" ref="form-login" tabindex="3">Sign In</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="ctl00_cphRoblox_SeparateSignup" class="separateSignUpFromLoginWithBorder">

                                            <div id="SplashPageConnect" class="fbSplashPageConnect">
                                                <a class="facebook-login" href="/web/20140502164823/http://www.roblox.com/facebook/signin?returnTo=%2Fhome" target="_top" ref="form-facebook">
                                                    <span class="left"></span>
                                                    <span class="middle">Login with Facebook<span>Login with Facebook</span></span>
                                                    <span class="right"></span>
                                                </a>
                                            </div>
                                            <div class="CenterSignupText">
                                                <span class="not-a-member">Not a member?</span>
                                                <a href="Login/NewAge.aspx" class="btn-medium btn-neutral" style="vertical-align: bottom; margin-left:5px;">Sign Up<span class="btn-text">Sign Up</span></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="FrontPageVideoIntro">
                                        <iframe width="380" height="250" src="https://www.youtube.com/embed/LHdA7Yc-8Rg?rel=0&controls=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <div style="float:right">
                                        <div id="FeaturedGameButtonContainer" style="height: 1px;">
                                            <div class="FeaturedGameButton VisitButtonPlay" id="FeaturedGameButton" ref="bigplaynow" placeid="41324860"></div>
                                        </div>

                                        <script type="text/javascript">
                                            Roblox = Roblox || {};

                                            Roblox.BCUpsellModal = function() {
                                                var resources = {
                                                    //<sl:translate>
                                                    title: "Builders Club Only",
                                                    body: "This is a premium feature only available to our Builders Club members.",
                                                    accept: "Upgrade Now"
                                                    //</sl:translate>
                                                };

                                                var open = function() {
                                                    var options = {
                                                        titleText: Roblox.BCUpsellModal.Resources.title,
                                                        bodyContent: Roblox.BCUpsellModal.Resources.body,
                                                        footerText: "",
                                                        acceptText: Roblox.BCUpsellModal.Resources.accept,
                                                        declineText: Roblox.GenericConfirmation.Resources.No,
                                                        acceptColor: Roblox.GenericConfirmation.green,
                                                        onAccept: function() {
                                                            window.location.href = '/Upgrades/BuildersClubMemberships.aspx';
                                                        },
                                                        imageUrl: 'https://web.archive.org/web/20140502164823/http://images.rbxcdn.com/43ac54175f3f3cd403536fedd9170c10.png'
                                                    };

                                                    Roblox.GenericConfirmation.open(
                                                        options
                                                    );
                                                };

                                                return {
                                                    open: open,
                                                    Resources: resources
                                                };
                                            }();
                                        </script>
                                        <script type="text/javascript">
                                            var play_placeId = 0;

                                            function redirectPlaceLauncherToLogin() {
                                                location.href = "/login/default.aspx?ReturnUrl=" + encodeURIComponent("/Default.aspx");
                                            }

                                            function redirectPlaceLauncherToRegister() {
                                                location.href = "/login/NewAge.aspx?ReturnUrl=" + encodeURIComponent("/Default.aspx");
                                            }

                                            function fireEventAction(action) {
                                                RobloxEventManager.triggerEvent('rbx_evt_popup_action', {
                                                    action: action
                                                });
                                            }

                                            $(function() {
                                                $('.VisitButtonPlay').click(function() {
                                                    play_placeId = $(this).attr('placeid');
                                                    Roblox.CharacterSelect.placeid = play_placeId;
                                                    Roblox.CharacterSelect.show();
                                                });
                                                $('.FeaturedGameButton').click(function() {});
                                                Roblox.CharacterSelect.robloxLaunchFunction = function(genderTypeID) {
                                                    if (genderTypeID == 3) {
                                                        var isInsideRobloxIDE = 'website';
                                                        if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) {
                                                            isInsideRobloxIDE = 'Studio';
                                                        };
                                                        GoogleAnalyticsEvents.FireEvent(['Play Location', 'Guest', isInsideRobloxIDE]);
                                                        GoogleAnalyticsEvents.FireEvent(['Play', 'Guest', '', 0]);
                                                        $(function() {
                                                            RobloxEventManager.triggerEvent('rbx_evt_play_guest', {
                                                                age: 'Unknown',
                                                                gender: 'Female'
                                                            });
                                                        });
                                                    } else {
                                                        var isInsideRobloxIDE = 'website';
                                                        if (Roblox && Roblox.Client && Roblox.Client.isIDE && Roblox.Client.isIDE()) {
                                                            isInsideRobloxIDE = 'Studio';
                                                        };
                                                        GoogleAnalyticsEvents.FireEvent(['Play Location', 'Guest', isInsideRobloxIDE]);
                                                        GoogleAnalyticsEvents.FireEvent(['Play', 'Guest', '', 1]);
                                                        $(function() {
                                                            RobloxEventManager.triggerEvent('rbx_evt_play_guest', {
                                                                age: 'Unknown',
                                                                gender: 'Male'
                                                            });
                                                        });
                                                    }
                                                    play_placeId = (typeof $(this).attr('placeid') === 'undefined') ? play_placeId : $(this).attr('placeid');
                                                    Roblox.Client.WaitForRoblox(function() {
                                                        RobloxLaunch.RequestGame('PlaceLauncherStatusPanel', play_placeId, genderTypeID);
                                                    });
                                                    return false;
                                                };
                                            });;
                                        </script>
                                    </div>
                                </div>

                                <!-- right column -->
                                <div class="overrideColumn2c">
                                    <div id="ctl00_cphRoblox_boxAdPanel" style="padding-left:5px;">
                                        <div style="height: 282px;">
                                            <div style="float:left;width:310px;" id="FrontPageRectangleAd">
                                                <div style="width: 300px">
                                                    <span id="3533353530373636" class="GPTAd rectangle" data-js-adtype="gptAd">
                                                        <script type="text/javascript">
                                                            googletag.cmd.push(function() {
                                                                googletag.display("3533353530373636");
                                                            });
                                                        </script>
                                                    </span>
                                                    <div class="ad-annotations " style="width: 300px">
                                                        <span class="ad-identification">Advertisement
                                                            <span> - </span>
                                                            <a href="" class="UpsellAdButton" title="Click to learn how to remove ads!">Why am I seeing ads?</a>
                                                        </span>
                                                        <a class="BadAdButton" href="/web/20140502164823/http://www.roblox.com/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="SidePanel" style="">
                                        <h2>Roblox News</h2>
                                        <div id="ctl00_cphRoblox_NewsFeed1_pRobloxNews">


                                            <div id="RobloxNews" style="float: none; width: 100%; overflow: visible;">
                                                <div style="margin-bottom: 15px;">


                                                    <div style="background: url(/images/BulletPointArrow.png) no-repeat center left;padding-left: 13px;margin-bottom: 10px;">
                                                        <a href="https://web.archive.org/web/20140502164823/http://blog.roblox.com/2014/05/devex-milestone-175k-paid-thegamer101-makes-10kmonth/?utm_source=rss&amp;utm_medium=rss&amp;utm_campaign=devex-milestone-175k-paid-thegamer101-makes-10kmonth" ref="news-article" class="roblox-interstitial">DevEx Milestone: $175K Paid &amp; TheGamer101 Makes $10K/Month</a>
                                                    </div>

                                                    <div style="background: url(/images/BulletPointArrow.png) no-repeat center left;padding-left: 13px;margin-bottom: 10px;">
                                                        <a href="https://web.archive.org/web/20140502164823/http://blog.roblox.com/2014/04/these-high-res-skyboxes-make-games-beautiful-fast/?utm_source=rss&amp;utm_medium=rss&amp;utm_campaign=these-high-res-skyboxes-make-games-beautiful-fast" ref="news-article" class="roblox-interstitial">These High-Res Skyboxes Make Games Beautiful — Fast</a>
                                                    </div>

                                                    <div style="background: url(/images/BulletPointArrow.png) no-repeat center left;padding-left: 13px;margin-bottom: 10px;">
                                                        <a href="https://web.archive.org/web/20140502164823/http://blog.roblox.com/2014/04/game-devs-impress-at-the-usa-science-engineering-fest/?utm_source=rss&amp;utm_medium=rss&amp;utm_campaign=game-devs-impress-at-the-usa-science-engineering-fest" ref="news-article" class="roblox-interstitial">Game Devs Impress at the USA Science &amp; Engineering Fest</a>
                                                    </div>

                                                    <div style="background: url(/images/BulletPointArrow.png) no-repeat center left;padding-left: 13px;margin-bottom: 10px;">
                                                        <a href="https://web.archive.org/web/20140502164823/http://blog.roblox.com/2014/04/fame-at-15-clonetrooper1019s-rise-to-game-dev-success/?utm_source=rss&amp;utm_medium=rss&amp;utm_campaign=fame-at-15-clonetrooper1019s-rise-to-game-dev-success" ref="news-article" class="roblox-interstitial">Fame at 15: CloneTrooper1019′s Rise to Game-Dev Success</a>
                                                    </div>


                                                </div>
                                                <a href="https://web.archive.org/web/20140502164823/http://blog.roblox.com/" class="SeeMore roblox-interstitial">See More</a><img border="0" alt="See more! " src="https://web.archive.org/web/20140502164823im_/http://images.rbxcdn.com/efe86a4cae90d4c37a5d73480dea4cb1.png" style="width:9px; height:9px;">

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- left column -->
                                <div class="overrideColumn1c">
                                    <div style="margin: 5px 0; width: 550px;"><a href="/web/20140502164823/http://www.roblox.com/games" class="RobloxFreeBuildingBanner" style="background-image: url('https://web.archive.org/web/20140502164823im_/http://images.rbxcdn.com/f0a141183a3c750815c53e4ad0d07d56.jpg');"></a></div>

                                    <div class="Content FeaturedGameBox">


                                        <style>
                                            .PlaceStatLabel {
                                                /* intentionally empty */
                                            }

                                            .PlaceStatValue {
                                                /* color: #888; */
                                                margin-left: 15px;
                                                font-weight: bold;
                                            }
                                        </style>


                                        <h1 style="margin:0px;">Featured Free Game</h1>
                                        <br>
                                        <span id="ctl00_cphRoblox_FeaturedGames1_GameName" class="placeName notranslate">Sword Fights on the Heights IV</span>
                                        by
                                        <a id="ctl00_cphRoblox_FeaturedGames1_CreatorHyperLinkNew" class="notranslate" ref="featured-username" href="User.aspx?ID=261">Shedletsky</a>

                                        <div class="FeaturedGame">
                                            <div class="FeaturedGameImage">
                                                <a id="ctl00_cphRoblox_FeaturedGames1_AssetThumbnailImage" title="Sword Fights on the Heights IV - a ROBLOX free game" href="/web/20140502164823/http://www.roblox.com/Sword-Fights-on-the-Heights-IV-place?id=47324" style="display:inline-block;height:230px;width:420px;cursor:pointer;"><img src="https://web.archive.org/web/20140502164823im_/http://t2.rbxcdn.com/556ab6226f6244dda1a1c5219eb43e38" height="230" width="420" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="Sword Fights on the Heights IV - a ROBLOX free game"></a>
                                            </div>
                                            <div class="FeaturedGameInfo">
                                                <a class="PlayThisFeaturedGame" style="background-image: url('https://web.archive.org/web/20140502164823im_/http://images.rbxcdn.com/149e8aed68b5902254193cdc9923f024.png')" href="/web/20140502164823/http://www.roblox.com/Sword-Fights-on-the-Heights-IV-place?id=47324" title="Play this free game!" ref="featured-playthis"></a>
                                                <div id="LastUpdateLabelDiv" class="PlaceStatLabel">Updated:</div>
                                                <div id="LastUpdate" class="PlaceStatValue"><span class="notranslate">2</span> months ago</div>
                                                <div id="FavoritedLabelDiv" class="PlaceStatLabel">Favorited:</div>
                                                <div id="Favorited" class="PlaceStatValue"><span class="notranslate">202,963</span> times</div>
                                                <div id="VisitedPanelLabelDiv" class="PlaceStatLabel">Visited:</div>
                                                <div id="ctl00_cphRoblox_FeaturedGames1_VisitedPanel" class="Visited PlaceStatValue"><span class="notranslate">9,485,604</span> times</div>
                                            </div>
                                        </div>


                                    </div>

                                    <div style="float:left;padding-top: 10px;">
                                        <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" src="https://web.archive.org/web/20140502164823if_/http://platform.twitter.com/widgets/follow_button.1397165098.html#_=1399049314976&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=ROBLOX&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" title="Twitter Follow Button" data-twttr-rendered="true" style="width: 120px; height: 20px;" data-ruffle-polyfilled=""></iframe>
                                    </div>

                                </div>

                                <br clear="all">
                                <img src="https://web.archive.org/web/20140502164823im_/http://media.fastclick.net/w/tre?ad_id=20713;evt=13114;cat1=14473;cat2=14474" id="ctl00_cphRoblox_fastclick" border="0" height="1" width="1">

                                <script type="text/javascript">
                                    FacebookLogout = function() {
                                        var appid = '190191627665278';
                                        FBLogout(appid);
                                    };

                                    // handle a session response from any of the auth related calls
                                    function handleLogout(response) {
                                        // if we dont have a session, just hide the user info
                                        if (!response.authResponse) {
                                            clearDisplay();
                                            return;
                                        }


                                        return;

                                        var modalProperties = {
                                            escClose: true,
                                            opacity: 80,
                                            overlayCss: {
                                                backgroundColor: "#000"
                                            },
                                            position: [120, 0]
                                        };
                                        $("#ConfirmFacebookLogout").modal(modalProperties);
                                    }
                                </script>

                                <div id="ConfirmFacebookLogout" class="GuestModePromptModal" style="width:400px; display:none">
                                    <div id="GuestDialog" style="background-color: white;">
                                        <div style="height:20px;"></div>

                                        <p style="font-size:medium;font-weight:bold;text-align:center; margin-left:10px;margin-right:10px">You are currently logged into Facebook. Also log out of Facebook?</p>

                                        <div style="height:20px;"></div>

                                        <div style="display:inline-block;" class="simplemodal-close">
                                            <div style="float:left; margin-left:70px;">
                                                <a onclick="FB.logout(clearSession);" id="ctl00_cphRoblox_AccountSyncUp" tabindex="8" class="btn-neutral btn-small" href="javascript:__doPostBack('ctl00$cphRoblox$AccountSyncUp','')">
                                                    <span>Logout</span>
                                                </a>
                                            </div>

                                            <div style="margin-right:50px;" class="simplemodal-close overrideDontLogout">
                                                <a id="ctl00_cphRoblox_LinkButton1" tabindex="8" class="btn-negative btn-medium" href="javascript:__doPostBack('ctl00$cphRoblox$LinkButton1','')">
                                                    <span>Don't Logout</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div style="height:20px;"></div>
                                    </div>
                                </div>

                                <div style="clear:both"></div>
                            </div>
                        </div>
                        <?= SiteFooter::render() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>