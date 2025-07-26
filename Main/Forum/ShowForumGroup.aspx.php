<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

$forum_group_id = isset($_GET['ForumGroupID']) ? intval($_GET['ForumGroupID']) : 0;

if ($forum_group_id === 0) {
    header("Location: /Forum/Default.aspx");
    exit();
}

// Fetch forum group details
$stmt = $conn->prepare('SELECT name FROM forum_groups WHERE id = :id');
$stmt->execute(['id' => $forum_group_id]);
$group = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$group) {
    // Or show a proper error page
    die('Forum group not found.');
}

// Fetch forums for this group
$forums_stmt = $conn->prepare('
    SELECT 
        f.id, f.name, f.description, f.threads_count, f.posts_count, 
        t.id as last_thread_id, t.subject as last_thread_subject, t.last_post_at, 
        u.username as last_post_username
    FROM forums f
    LEFT JOIN (
        SELECT forum_id, MAX(last_post_at) as max_last_post_at
        FROM threads
        GROUP BY forum_id
    ) as lt ON f.id = lt.forum_id
    LEFT JOIN threads t ON lt.forum_id = t.forum_id AND lt.max_last_post_at = t.last_post_at
    LEFT JOIN users u ON t.last_post_user_id = u.id
    WHERE f.group_id = :group_id
    ORDER BY f.sort_order ASC
');
$forums_stmt->execute(['group_id' => $forum_group_id]);
$forums = $forums_stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<!-- MachineID: WEB250 -->

<head id="ctl00_Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true" />
    <title><?= $site_properties['Title'] ?>.com</title>
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___3254191a0cea4af8e8a0fecd1a2685b0_m.css' />
    <link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___d0a32d7530b30a6f5d85fd297f8b6898_m.css' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="author" content="ROBLOX Corporation" />
    <meta id="ctl00_metadescription" name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine." />
    <meta id="ctl00_metakeywords" name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine" />
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
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js'></script>
    <script type='text/javascript'>
        window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")
    </script>
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
    <script type='text/javascript'>
        window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")
    </script>

    <script type='text/javascript' src='http://js.rbxcdn.com/cb493bb15f980f90c2ed26195e004097.js'></script>
    <script type='text/javascript'>
        Roblox.config.externalResources = ['/js/jquery/jquery-1.7.2.min.js', '/js/json2.min.js'];
        Roblox.config.paths['jQuery'] = 'http://js.rbxcdn.com/29cf397a226a92ca602cb139e9aae7d7.js';
        Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/7123e398c0433de33356ac718bab90d5.js';
        Roblox.config.paths['Pages.CatalogShared'] = 'http://js.rbxcdn.com/4eb48eec34ca711d5a7b08a4291ac753.js';
        Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/9b1b88b531c486003bbf39ae61963c27.js';
        Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';
        Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/e62257426488086a962edc938c73af47.js';
        Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/ff651da6797160efb3ebbb2c2f98fb86.js';
        Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/02a15e93afbd750f4d10a76c106d5993.js';
        Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/e8b579b8e31f8e7722a5d10900191fe7.js';
        Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/cdf392f4ea913f856dd792de27a7e917.js';
        Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/95cde5634c888fd071eef0d20c23f0ce.js';
        Roblox.config.paths['Widgets.Suggestions'] = 'http://js.rbxcdn.com/a63d457706dfbc230cf66a9674a1ca8b.js';
        Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';
    </script>
    <script type="text/javascript">
        $(function() {
            Roblox.JSErrorTracker.initialize({
                'suppressConsoleError': true,
                'internalEventListenerPixelEnabled': true
            });
        });
    </script>
    <script type='text/javascript' src='http://js.rbxcdn.com/e599082eecb1bd62ee2fb1a5391d2d9d.js'></script>

    <script type="text/javascript">
        function Roblox_Forums_Middle_728x90_RTP(estimate) {
            rtp['/1015347/Roblox_Forums_Middle_728x90'] = rp_valuation.estimate;
        }
        var rtp = rtp || {};
        oz_api = "valuation";
        oz_site = "9874/18868";
        oz_zone = "58960";
        oz_ad_slot_size = "728x90";
        oz_callback = Roblox_Forums_Middle_728x90_RTP;
    </script>
    <script type="text/javascript" src="http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script>
    <script>
        function Roblox_Forums_Right_160x600_RTP(estimate) {
            rtp['/1015347/Roblox_Forums_Right_160x600'] = rp_valuation.estimate;
        }
        var rtp = rtp || {};
        oz_api = "valuation";
        oz_site = "9874/18868";
        oz_zone = "58960";
        oz_ad_slot_size = "160x600";
        oz_callback = Roblox_Forums_Right_160x600_RTP;
    </script>
    <script type="text/javascript" src="http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script>
    <script>
        googletag.cmd.push(function() {
            Roblox = Roblox || {};
            Roblox.AdsHelper = Roblox.AdsHelper || {};
            Roblox.AdsHelper.slots = [];
            Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || [];
            Roblox.AdsHelper.slots.push({
                slot: googletag.defineSlot("/1015347/Roblox_Forums_Middle_728x90", [728, 90], "3635373030353238").addService(googletag.pubads()),
                id: "3635373030353238",
                path: "/1015347/Roblox_Forums_Middle_728x90"
            });
            Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || [];
            Roblox.AdsHelper.slots.push({
                slot: googletag.defineSlot("/1015347/Roblox_Forums_Right_160x600", [160, 600], "3236323637313235").addService(googletag.pubads()),
                id: "3236323637313235",
                path: "/1015347/Roblox_Forums_Right_160x600"
            });

            for (var key in Roblox.AdsHelper.slots) {
                var slot = Roblox.AdsHelper.slots[key].slot;
                var id = Roblox.AdsHelper.slots[key].id;
                var path = Roblox.AdsHelper.slots[key].path;

                slot.setTargeting('pos', path);
                slot.setTargeting('tier', rtp[path].tier);
                if (slot.renderEnded != "undefined") {
                    (function(slot, id) {
                        slot.renderEndedOld = slot.renderEnded;
                        slot.renderEnded = function() {
                            slot.renderEndedOld();
                            if ($('#' + id + '.gutter').css('display') == "none") {
                                $(document).trigger("GuttersHidden");
                            }
                            if ($('#' + id + '.filmstrip').css('display') == "none") {
                                $(document).trigger("FilmStripHidden");
                            }
                        };
                    }(slot, id));
                }
            }

            googletag.pubads().setTargeting("Age", "Unknown");
            googletag.pubads().setTargeting("Env", "Production");
            googletag.pubads().enableSingleRequest();
            googletag.pubads().collapseEmptyDivs();
            googletag.enableServices();
        });
    </script>
</head>

<body class="">

    <script type="text/javascript">
        Roblox.XsrfToken.setToken('');
    </script>

    <script type="text/javascript">
        if (top.location != self.location) {
            top.location = self.location.href;
        }
    </script>

    <style type="text/css">

    </style>
    <form name="aspnetForm" method="post" action="/Forum/ShowForumGroup.aspx?ForumGroupID=1" id="aspnetForm">
        <div>
            <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTc4OTUxMjU2Nw9kFgJmD2QWAgIBEBYCHgZhY3Rpb24FKS9Gb3J1bS9TaG93Rm9ydW1Hcm91cC5hc3B4P0ZvcnVtR3JvdXBJRD0xZBYCAgcPDxYCHgdWaXNpYmxlaGRkGAEFI2N0bDAwJHJieEdvb2dsZUFuYWx5dGljcyRNdWx0aVZpZXcxDw9kAgJkPN5c4VixAbYIQs1TwXIfAfpVJXw=" />
        </div>


        <script src="/ScriptResource.axd?d=W0XP0-dy84E6IZgdxAiCP3AZms7R_gB-lEXA8jMm0I0x2EcCOqvokQoEjFG_JWZ2k3BeNdwmJseVgirP_TBBhAcPCD1HIAyYwUKw2JZpaeBftk62pmdIKR_GoX7WwePNPyBH9vhPw6R87MOF9kNAIYO4od0RYiCIHNAjEJSPcWAR8IQ-BmK7gfmurI_qzLrEA5cyKbsrX2LxUvpSgDFtSkAxUlfXZwYY6700gACTc2yRklqJK7nxcDGU099BacIX-0Y0BlLzsAkYQv-wpeMBBx_XYNueMtuWbbB1tqFUC9l43RwPIHctlvzQoYfxfSuBRxvIIaNk14Cik6RoUxWIKXaa6xd6hzi_2TK9lfeVa617arzqQBnZ98mRllGEU4WAigwdjO3HZtq2Ifobz97p7i1PC72QoutpM-kWy_PepPa_NBso0Ppx12AnnbXP1TNCFG3Mlg2" type="text/javascript"></script>
        <div id="fb-root">
        </div>






        <div class="">
            <div class="">
                <div id="MasterContainer">



                    <script type="text/javascript">
                        $(function() {
                            function trackReturns() {
                                function dayDiff(d1, d2) {
                                    return Math.floor((d1 - d2) / 86400000);
                                }
                                if (!localStorage) return;

                                var cookieName = 'RBXReturn';
                                var cookieOptions = {
                                    expires: 9001
                                };
                                var cookie = localStorage.getItem(cookieName) || {};

                                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                                    localStorage.setItem(cookieName, {
                                        ts: new Date().toDateString()
                                    });
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



                    <script type="text/javascript">
                        Roblox.FixedUI.gutterAdsEnabled = false;
                    </script>


                    <div id="Container">



                        <div class="site-header">
                            <div id="navigation-container">
                                <a href="/Default.aspx" class="btn-logo" data-se="nav-logo"></a>
                                <div id="navigation-menu">
                                    <ul>
                                        <li><a href="/home" ref="nav-myroblox" data-se="nav-myhome">Home</a></li>
                                        <li><a data-se="nav-games" href="/games" ref="nav-games" title="Games">Games</a> </li>
                                        <li><a data-se="nav-catalog" href="/Catalog" ref="nav-catalog" title="Catalog">Catalog</a></li>

                                        <li><a data-se="nav-leaderboards" href="/leaderboards" title="Leaderboards" ref="nav-leaderboards">Leaderboards</a></li>

                                        <li><a data-se="nav-upgrade" href="/Upgrades/BuildersClubMemberships.aspx" title="Upgrade" ref="nav-buildersclub">Upgrade</a></li>
                                        <li><a data-se="nav-forum" href="/Forum/Default.aspx" title="Forum" ref="nav-forum">Forum</a></li>
                                        <li class="more-list-item" drop-down-nav-button="more-list-item">
                                            <div class="more-link-container">
                                                <a id="nav-more" title="More" data-se="nav-more" ref="nav-more">More<span id="more-menu-toggle"></span></a>
                                            </div>
                                            <div class="dropdownnavcontainer" style="display:none;" data-drop-down-nav-container="more-list-item">
                                                <div class="dropdownmainnav" style="z-index:1023">
                                                    <a class="dropdownoption" data-se="nav-more-browse" href="/Browse.aspx" title="People" ref="nav-people"><span>People</span></a>
                                                    <a class="dropdownoption roblox-interstitial" data-se="nav-more-blog" href="http://blog.roblox.com" title="Blog" ref="nav-news"><span>Blog</span></a>
                                                    <a class="dropdownoption" data-se="nav-more-sponsoredpage" href="/event/summergames" title="Summer Games" ref="nav-sponsoredpage">
                                                        <span style="display:block;">
                                                            <img src="http://images.rbxcdn.com/358a463df4043bcc48f4313f7475f4d1" />
                                                        </span>
                                                    </a>
                                                    <a class="dropdownoption" data-se="nav-more-help" href="/Help/Builderman.aspx" title="Help" ref="nav-help"><span>Help</span></a>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div id="header-login-container">
                                    <div id="header-login-wrapper" class="iframe-login-signup" data-display-opened="">
                                        <a id="header-signup" href="/Login/NewAge.aspx">Sign Up</a>
                                        <span id="header-or">or</span>
                                        <span id="login-span">
                                            <a id="header-login" class="btn-control btn-control-large">Login <span class="grey-arrow">▼</span></a>
                                        </span>
                                        <div id="iFrameLogin" style="display:none">
                                            <iframe class="login-frame" src="https://www.roblox.com/Login/iFrameLogin.aspx?loginRedirect=True&amp;parentUrl=http%3a%2f%2fwww.roblox.com%2fForum%2fShowForumGroup.aspx%3fForumGroupID%3d1" scrolling="no" frameborder="0"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(function() {
                                $('.more-list-item').bind('showDropDown', function() {
                                    var maxWidth = $('#navigation-menu .dropdownnavcontainer').width();
                                    $('a.dropdownoption span').each(function(index, elem) {
                                        elem = $(elem);
                                        if (elem.outerWidth() > maxWidth) {
                                            maxWidth = elem.outerWidth();
                                        }
                                    });
                                    maxWidth = maxWidth + 5;
                                    $('#navigation-menu .dropdownoption').each(function(index, elem) {
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

                    </div>




                    <div class="forceSpace">&nbsp;</div>
                    <div id="AdvertisingLeaderboard">

                        <div style="width: 728px">
                            <span id='3635373030353238' class="GPTAd banner" data-js-adtype="gptAd">
                                <script type="text/javascript">
                                    googletag.cmd.push(function() {
                                        googletag.display("3635373030353238");
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


                    <noscript>
                        <div class="SystemAlert">
                            <div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div>
                        </div>
                    </noscript>

                    <div id="BodyWrapper">
                        <div id="RepositionBody">
                            <div id="Body" style='width:970px;'>

                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tr valign="top">

                                        <!-- left column -->
                                        <td>&nbsp;&nbsp;&nbsp;</td>

                                        <!-- center column -->
                                        <td id="ctl00_cphRoblox_CenterColumn" width="95%" class="CenterColumn">
                                            <br />
                                            <table>
                                                <tr>
                                                    <td align="left"><span id="ctl00_cphRoblox_Whereami1">
                                                            <div>
                                                                <nobr>
                                                                    <a id="ctl00_cphRoblox_Whereami1_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx">ROBLOX Forum</a>
                                                                </nobr>
                                                                <nobr>
                                                                    <span id="ctl00_cphRoblox_Whereami1_ctl00_ForumGroupSeparator" class="normalTextSmallBold"> » </span>
                                                                    <a id="ctl00_cphRoblox_Whereami1_ctl00_LinkForumGroup" class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx.php?ForumGroupID=<?php echo htmlspecialchars($forum_group_id); ?>"><?php echo htmlspecialchars($group['name']); ?></a>
                                                                </nobr>
                                                                <nobr>


                                                                </nobr>
                                                            </div>
                                                        </span></td>
                                                    <td align="right"><span id="ctl00_cphRoblox_Navigationmenu1">

                                                            <div id="forum-nav" style="text-align: right">
                                                                <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_HomeMenu" class="menuTextLink first" href="/Forum/Default.aspx">Home</a>
                                                                <a id="ctl00_cphRoblox_Navigationmenu1_ctl00_SearchMenu" class="menuTextLink" href="/Forum/Search/default.aspx">Search</a>







                                                            </div>
                                                        </span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp; &nbsp; &nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <table class="table" width="100%" cellpadding="2" cellspacing="1" border="0">
                                                            <tr class="table-header forum-table-header">
                                                                <th class="first" colspan="2"><a class="forumTitle" href="/Forum/ShowForumGroup.aspx?ForumGroupID=<?= $forum_group_id ?>"><?= htmlspecialchars($group['name']) ?></a></th>
                                                                <th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Threads&nbsp;&nbsp;</th>
                                                                <th style="width:50px;white-space:nowrap;">&nbsp;&nbsp;Posts&nbsp;&nbsp;</th>
                                                                <th style="width:135px;white-space:nowrap;">&nbsp;Last Post&nbsp;</th>
                                                            </tr>
                                                            <?php if (empty($forums)): ?>
                                                                <tr class="forum-table-row">
                                                                    <td colspan="5" align="center"><span class="normalTextSmaller">No forums found in this group.</span></td>
                                                                </tr>
                                                            <?php else: ?>
                                                                <?php foreach ($forums as $forum): ?>
                                                                    <tr class="forum-table-row">
                                                                        <td colspan="2" style="width:80%;">
                                                                            <a class="forum-summary" href="/Forum/ShowForum.aspx?ForumID=<?= $forum['id'] ?>">
                                                                                <div class="forumTitle">
                                                                                    <?= htmlspecialchars($forum['name']) ?>
                                                                                </div>
                                                                                <div>
                                                                                    <?= htmlspecialchars($forum['description']) ?>
                                                                                </div>
                                                                            </a>
                                                                        </td>
                                                                        <td class="forum-centered-cell" align="center"><span class="normalTextSmaller"><?= number_format($forum['threads_count']) ?></span></td>
                                                                        <td class="forum-centered-cell" align="center"><span class="normalTextSmaller"><?= number_format($forum['posts_count']) ?></span></td>
                                                                        <td align="center">
                                                                            <?php if ($forum['last_post_at']): ?>
                                                                                <div class="normalTextSmaller">
                                                                                    <a href="/Forum/ShowPost.aspx?PostID=<?php echo $forum['last_thread_id']; ?>#last"><?php echo date('n/j/Y g:i A', strtotime($forum['last_post_at'])); ?></a>
                                                                                    <br />
                                                                                    by <a href="/User.aspx?UserName=<?php echo urlencode($forum['last_post_username']); ?>"><?php echo htmlspecialchars($forum['last_post_username']); ?></a>
                                                                                </div>
                                                                            <?php else: ?>
                                                                                <span class="normalTextSmaller">N/A</span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp; &nbsp; &nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><span id="ctl00_cphRoblox_Whereami2">
                                                            <div>
                                                                <nobr>
                                                                    <a id="ctl00_cphRoblox_Whereami2_ctl00_LinkHome" class="linkMenuSink notranslate" href="/Forum/Default.aspx">ROBLOX Forum</a>
                                                                </nobr>
                                                                <nobr>
                                                                    <span id="ctl00_cphRoblox_Whereami2_ctl00_ForumGroupSeparator" class="normalTextSmallBold"> » </span>
                                                                    <a id="ctl00_cphRoblox_Whereami2_ctl00_LinkForumGroup" class="linkMenuSink notranslate" href="/Forum/ShowForumGroup.aspx.php?ForumGroupID=<?php echo htmlspecialchars($forum_group_id); ?>"><?php echo htmlspecialchars($group['name']); ?></a>
                                                                </nobr>
                                                                <nobr>


                                                                </nobr>
                                                            </div>
                                                        </span></td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td class="CenterColumn">&nbsp;&nbsp;&nbsp;</td>

                                        <!-- right margin -->
                                        <td Width="160px" style="padding-top:62px;">
                                            <div style="width: 160px">
                                                <span id='3236323637313235' class="GPTAd skyscraper" data-js-adtype="gptAd">
                                                    <script type="text/javascript">
                                                        googletag.cmd.push(function() {
                                                            googletag.display("3236323637313235");
                                                        });
                                                    </script>
                                                </span>
                                                <div class="ad-annotations " style="width: 160px">
                                                    <span class="ad-identification">Advertisement
                                                    </span>
                                                    <a class="BadAdButton" href="/Ads/ReportAd.aspx" title="click to report an offensive ad">Report</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="RightColumn">&nbsp;&nbsp;&nbsp;</td>
                                    </tr>
                                </table>

                                <div style="clear:both"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="Footer" class="footer-container">
                    <div class="FooterNav">
                        <a href="/info/Privacy.aspx">Privacy Policy</a>
                        &nbsp;|&nbsp;
                        <a href="http://corp.roblox.com/advertise-on-roblox" class="roblox-interstitial">Advertise with Us</a>
                        &nbsp;|&nbsp;
                        <a href="http://corp.roblox.com/roblox-press" class="roblox-interstitial">Press</a>
                        &nbsp;|&nbsp;
                        <a href="http://corp.roblox.com/contact-us" class="roblox-interstitial">Contact Us</a>
                        &nbsp;|&nbsp;
                        <a href="http://corp.roblox.com/" class="roblox-interstitial">About Us</a>
                        &nbsp;|&nbsp;
                        <a href="http://blog.roblox.com" class="roblox-interstitial">Blog</a>
                        &nbsp;|&nbsp;
                        <a href="http://corp.roblox.com/jobs" class="roblox-interstitial">Jobs</a>
                        &nbsp;|&nbsp;
                        <a href="http://corp.roblox.com/parents" class="roblox-interstitial">Parents</a>
                        <span class="LanguageOptionElement">&nbsp;|&nbsp;</span>
                        <span ref="footer-parents" class="LanguageOptionElement LanguageTrigger roblox-interstitial" drop-down-nav-button="LanguageTrigger">English&nbsp;<span class="FooterArrow">▼</span>
                            <div class="dropuplanguagecontainer" style="display:none;" data-drop-down-nav-container="LanguageTrigger">
                                <div class="dropdownmainnav" style="z-index:1023">
                                    <a href="/UserLanguage/LanguageRedirect?languageCode=de&amp;relativePath=%2fForum%2fShowForumGroup.aspx%3fForumGroupID%3d1" class="LanguageOption js-lang" data-js-langcode="de"><span class="notranslate">Deutsch</span>&nbsp;(German) </a>
                                </div>
                            </div>
                        </span>
                    </div>
                    <div class="FooterNav">
                        <div id="SEOGenreLinks" class="SEOGenreLinks">
                            <a href="/all-games">All Games</a>
                            <span>|</span>
                            <a href="/building-games">Building</a>
                            <span>|</span>
                            <a href="/horror-games">Horror</a>
                            <span>|</span>
                            <a href="/town-and-city-games">Town and City</a>
                            <span>|</span>
                            <a href="/military-games">Military</a>
                            <span>|</span>
                            <a href="/comedy-games">Comedy</a>
                            <span>|</span>
                            <a href="/medieval-games">Medieval</a>
                            <span>|</span>
                            <a href="/adventure-games">Adventure</a>
                            <span>|</span>
                            <a href="/sci-fi-games">Sci-Fi</a>
                            <span>|</span>
                            <a href="/naval-games">Naval</a>
                            <span>|</span>
                            <a href="/fps-games">FPS</a>
                            <span>|</span>
                            <a href="/rpg-games">RPG</a>
                            <span>|</span>
                            <a href="/sports-games">Sports</a>
                            <span>|</span>
                            <a href="/fighting-games">Fighting</a>
                            <span>|</span>
                            <a href="/western-games">Western</a>

                        </div>
                    </div>
                    <div class="legal">
                        <div class="left">
                            <div id="a15b1695-1a5a-49a9-94f0-9cd25ae6c3b2">
                                <a href="//privacy.truste.com/privacy-seal/Roblox-Corporation/validation?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" title="TRUSTe Children privacy certification" target="_blank">
                                    <img style="border: none" src="//privacy-policy.truste.com/privacy-seal/Roblox-Corporation/seal?rid=2428aa2a-f278-4b6d-9095-98c4a2954215" width="133" height="45" alt="TRUSTe Children privacy certification" />
                                </a>
                            </div>
                        </div>
                        <div class="right">
                            <p class="Legalese">
                                ROBLOX, "Online Building Toy", characters, logos, names, and all related indicia are trademarks of <a href="http://corp.roblox.com/" ref="footer-smallabout" class="roblox-interstitial">ROBLOX Corporation</a>, ©2014. Patents pending.
                                ROBLOX is not sponsored, authorized or endorsed by any producer of plastic building bricks, including The LEGO Group, MEGA Brands, and K'Nex, and no resemblance to the products of these companies is intended. Use of this site signifies your acceptance of the <a href="/info/terms-of-service" ref="footer-terms">Terms and Conditions</a>.
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        <div id="ChatContainer" style="position: fixed; bottom: 0; right: 0; z-index: 10020">


        </div>


        <script type="text/javascript">
            function urchinTracker() {};
            GoogleAnalyticsReplaceUrchinWithGAJS = true;
        </script>


    </form>



    <style>
        #win_firefox_install_img .installation {
            width: 869px;
            height: 331px;
        }

        #mac_firefox_install_img .installation {
            width: 250px;
        }

        #mac_chrome_install_img .activation {
            width: 250px;
        }
    </style>

    <div id="InstallationInstructions" class="modalPopup blueAndWhite" style="display:none;overflow:hidden">
        <a id="CancelButton2" onclick="return Roblox.Client._onCancel();" class="ImageButton closeBtnCircle_35h ABCloseCircle"></a>
        <div style="padding-bottom:10px;text-align:center">
            <br /><br />
        </div>
    </div>



    <div id="pluginObjDiv" style="height:1px;width:1px;visibility:hidden;position: absolute;top: 0;"></div>
    <iframe id="downloadInstallerIFrame" style="visibility:hidden;height:0;width:1px;position:absolute"></iframe>


    <script type='text/javascript' src='http://js.rbxcdn.com/112cc6be2c562a49c6cc7885e9ff358a.js'></script>

    <script type="text/javascript">
        Roblox.Client._skip = '/install/unsupported.aspx';
        Roblox.Client._CLSID = '';
        Roblox.Client._installHost = '';
        Roblox.Client.ImplementsProxy = false;
        Roblox.Client._silentModeEnabled = false;
        Roblox.Client._bringAppToFrontEnabled = false;
        Roblox.Client._currentPluginVersion = '';

        Roblox.Client._installSuccess = function() {
            GoogleAnalyticsEvents && GoogleAnalyticsEvents.ViewVirtual('InstallSuccess');
        };
    </script>


    <div id="PlaceLauncherStatusPanel" style="display:none;width:300px">
        <div class="modalPopup blueAndWhite PlaceLauncherModal" style="min-height: 160px">
            <div id="Spinner" class="Spinner" style="margin:0 1em 1em 0; padding:20px 0;">
                <img src="http://images.rbxcdn.com/e998fb4c03e8c2e30792f2f3436e9416.gif" height="32" width="32" alt="Progress" />
            </div>
            <div id="status" style="min-height:40px;text-align:center;margin:5px 20px">
                <div id="Starting" class="PlaceLauncherStatus MadStatusStarting" style="display:block">
                    Starting Roblox...
                </div>
                <div id="Waiting" class="PlaceLauncherStatus MadStatusField">Connecting to Players...</div>
                <div id="StatusBackBuffer" class="PlaceLauncherStatus PlaceLauncherStatusBackBuffer MadStatusBackBuffer"></div>
            </div>
            <div style="text-align:center;margin-top:1em">
                <input type="button" class="Button CancelPlaceLauncherButton translate" value="Cancel" />
            </div>
        </div>
    </div>



    <script type='text/javascript' src='http://js.rbxcdn.com/507606ba77acf2ff29dd3ec7cb668f06.js'></script>

    <div id="videoPrerollPanel" style="display:none">
        <div id="videoPrerollTitleDiv">
            Gameplay sponsored by:
        </div>
        <div id="videoPrerollMainDiv"></div>
        <div id="videoPrerollCompanionAd"></div>
        <div id="videoPrerollLoadingDiv">
            Loading <span id="videoPrerollLoadingPercent">0%</span> - <span id="videoPrerollMadStatus" class="MadStatusField">Starting game...</span><span id="videoPrerollMadStatusBackBuffer" class="MadStatusBackBuffer"></span>
            <div id="videoPrerollLoadingBar">
                <div id="videoPrerollLoadingBarCompleted">
                </div>
            </div>
        </div>
        <div id="videoPrerollJoinBC">
            <span>Get more with Builders Club!</span>
            <a href="/Upgrades/BuildersClubMemberships.aspx?ref=vpr" target="_blank" id="videoPrerollJoinBCButton"></a>
        </div>
    </div>
    <script type="text/javascript">
        Roblox.VideoPreRoll.showVideoPreRoll = false;
        Roblox.VideoPreRoll.loadingBarMaxTime = 33000;
        Roblox.VideoPreRoll.videoOptions.key = "robloxcorporation";
        Roblox.VideoPreRoll.videoOptions.categories = "NonBC,IsLoggedIn,AgeUnknown,GenderUnknown";
        Roblox.VideoPreRoll.videoOptions.id = "games";
        Roblox.VideoPreRoll.videoLoadingTimeout = 11000;
        Roblox.VideoPreRoll.videoPlayingTimeout = 41000;
        Roblox.VideoPreRoll.videoLogNote = "NotWindows";
        Roblox.VideoPreRoll.logsEnabled = true;
        Roblox.VideoPreRoll.excludedPlaceIds = "32373412";

        Roblox.VideoPreRoll.specificAdOnPlacePageEnabled = true;
        Roblox.VideoPreRoll.specificAdOnPlacePageId = 57507247;
        Roblox.VideoPreRoll.specificAdOnPlacePageCategory = "stooges";


        Roblox.VideoPreRoll.specificAdOnPlacePage2Enabled = true;
        Roblox.VideoPreRoll.specificAdOnPlacePage2Id = 122911678;
        Roblox.VideoPreRoll.specificAdOnPlacePage2Category = "lego";

        $(Roblox.VideoPreRoll.checkEligibility);
    </script>


    <div id="GuestModePrompt_BoyGirl" class="Revised GuestModePromptModal" style="display:none;">
        <div class="simplemodal-close">
            <a class="ImageButton closeBtnCircle_20h" style="cursor: pointer; margin-left:455px;top:7px; position:absolute;"></a>
        </div>
        <div class="Title">
            Choose Your Character
        </div>
        <div style="min-height: 275px; background-color: white;">
            <div style="clear:both; height:25px;"></div>

            <div style="text-align: center;">
                <div class="VisitButtonsGuestCharacter VisitButtonBoyGuest" style="float:left; margin-left:45px;"></div>
                <div class="VisitButtonsGuestCharacter VisitButtonGirlGuest" style="float:right; margin-right:45px;"></div>
            </div>
            <div style="clear:both; height:25px;"></div>
            <div class="RevisedFooter">
                <div style="width:200px;margin:10px auto 0 auto;">
                    <a href="#" onclick="redirectPlaceLauncherToRegister(); return false;">
                        <div class="RevisedCharacterSelectSignup"></div>
                    </a>
                    <a class="HaveAccount" href="#" onclick="redirectPlaceLauncherToLogin();return false;">I have an account</a>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function checkRobloxInstall() {
            window.location = '/install/unsupported.aspx';
            return false;
        }
        if (typeof MadStatus === "undefined") {
            MadStatus = {};
        }

        MadStatus.Resources = {
            //<sl:translate>
            accelerating: "Accelerating",
            aggregating: "Aggregating",
            allocating: "Allocating",
            acquiring: "Acquiring",
            automating: "Automating",
            backtracing: "Backtracing",
            bloxxing: "Bloxxing",
            bootstrapping: "Bootstrapping",
            calibrating: "Calibrating",
            correlating: "Correlating",
            denoobing: "De-noobing",
            deionizing: "De-ionizing",
            deriving: "Deriving",
            energizing: "Energizing",
            filtering: "Filtering",
            generating: "Generating",
            indexing: "Indexing",
            loading: "Loading",
            noobing: "Noobing",
            optimizing: "Optimizing",
            oxidizing: "Oxidizing",
            queueing: "Queueing",
            parsing: "Parsing",
            processing: "Processing",
            rasterizing: "Rasterizing",
            reading: "Reading",
            registering: "Registering",
            rerouting: "Re-routing",
            resolving: "Resolving",
            sampling: "Sampling",
            updating: "Updating",
            writing: "Writing",
            blox: "Blox",
            countzero: "Count Zero",
            cylon: "Cylon",
            data: "Data",
            ectoplasm: "Ectoplasm",
            encryption: "Encryption",
            event: "Event",
            farnsworth: "Farnsworth",
            bebop: "Bebop",
            fluxcapacitor: "Flux Capacitor",
            fusion: "Fusion",
            game: "Game",
            gibson: "Gibson",
            host: "Host",
            mainframe: "Mainframe",
            metaverse: "Metaverse",
            nerfherder: "Nerf Herder",
            neutron: "Neutron",
            noob: "Noob",
            photon: "Photon",
            profile: "Profile",
            script: "Script",
            skynet: "Skynet",
            tardis: "TARDIS",
            virtual: "Virtual",
            analogs: "Analogs",
            blocks: "Blocks",
            cannon: "Cannon",
            channels: "Channels",
            core: "Core",
            database: "Database",
            dimensions: "Dimensions",
            directives: "Directives",
            engine: "Engine",
            files: "Files",
            gear: "Gear",
            index: "Index",
            layer: "Layer",
            matrix: "Matrix",
            paradox: "Paradox",
            parameters: "Parameters",
            parsecs: "Parsecs",
            pipeline: "Pipeline",
            players: "Players",
            ports: "Ports",
            protocols: "Protocols",
            reactors: "Reactors",
            sphere: "Sphere",
            spooler: "Spooler",
            stream: "Stream",
            switches: "Switches",
            table: "Table",
            targets: "Targets",
            throttle: "Throttle",
            tokens: "Tokens",
            torpedoes: "Torpedoes",
            tubes: "Tubes"
            //</sl:translate>
        };
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

    <div class="ConfirmationModal modalPopup unifiedModal smallModal" data-modal-handle="confirmation" style="display:none;">
        <a class="genericmodal-close ImageButton closeBtnCircle_20h"></a>
        <div class="Title"></div>
        <div class="GenericModalBody">
            <div class="TopBody">
                <div class="ImageContainer roblox-item-image" data-image-size="small" data-no-overlays data-no-click>
                    <img class="GenericModalImage" alt="generic image" />
                </div>
                <div class="Message"></div>
            </div>
            <div class="ConfirmationModalButtonContainer">
                <a href id="roblox-confirm-btn"><span></span></a>
                <a href id="roblox-decline-btn"><span></span></a>
            </div>
            <div class="ConfirmationModalFooter">

            </div>
        </div>
        <script type="text/javascript">
            //<sl:translate>
            Roblox.GenericConfirmation.Resources = {
                yes: "Yes",
                No: "No",
                Confirm: "Confirm",
                Cancel: "Cancel"
            };
            //</sl:translate>
        </script>
    </div>


    <img src="https://secure.adnxs.com/seg?add=550800&t=2" width="1" height="1" style="display:none;" />

</body>

</html>