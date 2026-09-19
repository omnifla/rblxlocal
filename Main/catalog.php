<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteAlert;

function sanitizeNameForUrl(string $name): string
{
    $name = preg_replace('/[^a-zA-Z0-9 -]/', '', $name);
    $name = str_replace(' ', '-', $name);
    $name = preg_replace('/-+/', '-', $name);
    $name = trim($name, '-');
    return $name;
}

function timeElapsedString($datetime, $full = false)
{
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

$stmt = $conn->prepare('
    SELECT a.*, u.username,
        COALESCE((SELECT COUNT(1) FROM asset_sales s WHERE s.asset_id = a."AssetId"), 0) AS Sales
    FROM assets a 
    LEFT JOIN users u ON a."OwnerId" = u.id 
    WHERE a."OwnerId" = 1 
    ORDER BY a."UpdatedDate" DESC 
    LIMIT 22
');
$stmt->execute();
$assets = $stmt->fetchAll(PDO::FETCH_ASSOC);

$bigCount = 0;
$smallCount = 0;

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">

<head id="ctl00_Head1">
    <script async="" type="text/javascript" src="https://www.googletagservices.com/tag/js/gpt.js"></script>
    <script type="text/javascript" src="https://js.rbxcdn.com/1612c57544c7977e19cd15c824f7ecc3.js"></script>
    <script type="text/javascript" src="https://js.rbxcdn.com/8babd891cf420dfe3999b3824a0154cb.js"></script>
    <script type="text/javascript" src="https://js.rbxcdn.com/fbb86cf0752d23f389f983419d3085b4.js"></script>
    <script type="text/javascript" async="" src="https://ssl.google-analytics.com/ga.js"></script>
    <title>
        Catalog - ROBLOX
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">

    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___52c69b42777a376ab8c76204ed8e75e2_m.css">

    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___5b917c1f2444dcb817feabfc50750286_m.css">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="en-us">
    <meta name="author" content="ROBLOX Corporation">
    <meta id="ctl00_metadescription" name="description"
        content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine.">
    <meta id="ctl00_metakeywords" name="keywords"
        content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">

        var _gaq = _gaq || [];

        _gaq.push(['_setAccount', 'UA-11419793-1']);
        _gaq.push(['_setCampSourceKey', 'rbx_source']);
        _gaq.push(['_setCampMediumKey', 'rbx_medium']);
        _gaq.push(['_setCampContentKey', 'rbx_campaign']);
        _gaq.push(['_setDomainName', 'roblox.local']);
        _gaq.push(['b._setAccount', 'UA-486632-1']);
        _gaq.push(['b._setCampSourceKey', 'rbx_source']);
        _gaq.push(['b._setCampMediumKey', 'rbx_medium']);
        _gaq.push(['b._setCampContentKey', 'rbx_campaign']);

        _gaq.push(['b._setDomainName', 'roblox.local']);

        _gaq.push(['b._setCustomVar', 1, 'Visitor', 'Anonymous', 2]);
        _gaq.push(['b._trackPageview']);




        _gaq.push(['c._setAccount', 'UA-26810151-2']);
        _gaq.push(['c._setDomainName', 'roblox.local']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>


</head>

<body roblox-js-usercheckcontrollerenabled="False" class="">

    <div id="roblox-linkify" data-enabled="true"
        data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer)\.roblox\.local|robloxlabs\.local)((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))"
        data-regex-flags="gm"></div>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js"></script>
    <script
        type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
    <script type="text/javascript"
        src="//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js"></script>
    <script
        type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js"></script>
    <script
        type="text/javascript">window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
    <script type="text/javascript" src="https://js.rbxcdn.com/61793166c3a1b38a80ed918b05bc9100.js"></script>
    <script
        type="text/javascript">Roblox.config.externalResources = []; Roblox.config.paths['Pages.Catalog'] = 'http://js.rbxcdn.com/1612c57544c7977e19cd15c824f7ecc3.js'; Roblox.config.paths['Pages.CatalogShared'] = 'http://js.rbxcdn.com/209f2b781ea84e8d0332648ddf547d57.js'; Roblox.config.paths['Pages.Messages'] = 'http://js.rbxcdn.com/e8cbac58ab4f0d8d4c707700c9f97630.js'; Roblox.config.paths['Resources.Messages'] = 'http://js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js'; Roblox.config.paths['Widgets.AvatarImage'] = 'http://js.rbxcdn.com/bbaeb48f3312bad4626e00c90746ffc0.js'; Roblox.config.paths['Widgets.DropdownMenu'] = 'http://js.rbxcdn.com/7b436bae917789c0b84f40fdebd25d97.js'; Roblox.config.paths['Widgets.GroupImage'] = 'http://js.rbxcdn.com/33d82b98045d49ec5a1f635d14cc7010.js'; Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'http://js.rbxcdn.com/fbb86cf0752d23f389f983419d3085b4.js'; Roblox.config.paths['Widgets.ItemImage'] = 'http://js.rbxcdn.com/8babd891cf420dfe3999b3824a0154cb.js'; Roblox.config.paths['Widgets.PlaceImage'] = 'http://js.rbxcdn.com/f2697119678d0851cfaa6c2270a727ed.js'; Roblox.config.paths['Widgets.SurveyModal'] = 'http://js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script>
    <script type="text/javascript">
        $(function () {
            Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true });
        });
    </script>
    <script type="text/javascript" src="https://js.rbxcdn.com/b3bb47d913a29004bf50d9a896f46b4a.js"></script>
    <script type="text/javascript">
        if (typeof (Roblox) === "undefined") { Roblox = {}; }
        Roblox.Endpoints = Roblox.Endpoints || {};
        Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
        Roblox.Endpoints.Urls['/asset/'] = 'http://www.roblox.local/asset/';
        Roblox.Endpoints.Urls['/client-status/set'] = 'http://www.roblox.local/client-status/set';
        Roblox.Endpoints.Urls['/client-status'] = 'http://www.roblox.local/client-status';
        Roblox.Endpoints.Urls['/game/'] = 'http://www.roblox.local/game/';
        Roblox.Endpoints.Urls['/game/edit.ashx'] = 'http://www.roblox.local/game/edit.ashx';
        Roblox.Endpoints.Urls['/game/getauthticket'] = 'http://www.roblox.local/game/getauthticket';
        Roblox.Endpoints.Urls['/game/placelauncher.ashx'] = 'http://www.roblox.local/game/placelauncher.ashx';
        Roblox.Endpoints.Urls['/game/report-stats'] = 'http://www.roblox.local/game/report-stats';
        Roblox.Endpoints.Urls['/game/report-event'] = 'http://www.roblox.local/game/report-event';
        Roblox.Endpoints.Urls['/chat/chat'] = 'http://www.roblox.local/chat/chat';
        Roblox.Endpoints.Urls['/chat/party/setting'] = 'http://www.roblox.local/chat/party/setting';
        Roblox.Endpoints.Urls['/chat/get.ashx'] = 'http://www.roblox.local/chat/get.ashx';
        Roblox.Endpoints.Urls['/chat/party.ashx'] = 'http://www.roblox.local/chat/party.ashx';
        Roblox.Endpoints.Urls['/chat/send.ashx'] = 'http://www.roblox.local/chat/send.ashx';
        Roblox.Endpoints.Urls['/chat/utility.ashx'] = 'http://www.roblox.local/chat/utility.ashx';
        Roblox.Endpoints.Urls['/chat/friendhandler.ashx'] = 'http://www.roblox.local/chat/friendhandler.ashx';
        Roblox.Endpoints.Urls['/presence/users'] = 'http://www.roblox.local/presence/users';
        Roblox.Endpoints.Urls['/presence/user'] = 'http://www.roblox.local/presence/user';
        Roblox.Endpoints.Urls['/friends/list'] = 'http://www.roblox.local/friends/list';
        Roblox.Endpoints.Urls['/navigation/getCount'] = 'http://www.roblox.local/navigation/getCount';
        Roblox.Endpoints.Urls['/catalog/browse.aspx'] = 'http://www.roblox.local/catalog/browse.aspx';
        Roblox.Endpoints.Urls['/catalog'] = 'http://www.roblox.local/catalog';
        Roblox.Endpoints.Urls['/catalog/'] = 'http://www.roblox.local/catalog/';
        Roblox.Endpoints.Urls['/catalog/html'] = 'http://www.roblox.local/catalog/html';
        Roblox.Endpoints.Urls['/catalog/json'] = 'http://www.roblox.local/catalog/json';
        Roblox.Endpoints.Urls['/catalog/contents'] = 'http://www.roblox.local/catalog/contents';
        Roblox.Endpoints.Urls['/catalog/lists.aspx'] = 'http://www.roblox.local/catalog/lists.aspx';
        Roblox.Endpoints.Urls['/asset-hash-thumbnail/image'] = 'http://www.roblox.local/asset-hash-thumbnail/image';
        Roblox.Endpoints.Urls['/asset-hash-thumbnail/json'] = 'http://www.roblox.local/asset-hash-thumbnail/json';
        Roblox.Endpoints.Urls['/asset-thumbnail-3d/json'] = 'http://www.roblox.local/asset-thumbnail-3d/json';
        Roblox.Endpoints.Urls['/asset-thumbnail/image'] = 'http://www.roblox.local/asset-thumbnail/image';
        Roblox.Endpoints.Urls['/asset-thumbnail/json'] = 'http://www.roblox.local/asset-thumbnail/json';
        Roblox.Endpoints.Urls['/asset-thumbnail/url'] = 'http://www.roblox.local/asset-thumbnail/url';
        Roblox.Endpoints.Urls['/asset/request-thumbnail-fix'] = 'http://www.roblox.local/asset/request-thumbnail-fix';
        Roblox.Endpoints.Urls['/avatar-thumbnail-3d/json'] = 'http://www.roblox.local/avatar-thumbnail-3d/json';
        Roblox.Endpoints.Urls['/avatar-thumbnail/image'] = 'http://www.roblox.local/avatar-thumbnail/image';
        Roblox.Endpoints.Urls['/avatar-thumbnail/json'] = 'http://www.roblox.local/avatar-thumbnail/json';
        Roblox.Endpoints.Urls['/avatar-thumbnails'] = 'http://www.roblox.local/avatar-thumbnails';
        Roblox.Endpoints.Urls['/avatar/request-thumbnail-fix'] = 'http://www.roblox.local/avatar/request-thumbnail-fix';
        Roblox.Endpoints.Urls['/bust-thumbnail/json'] = 'http://www.roblox.local/bust-thumbnail/json';
        Roblox.Endpoints.Urls['/group-thumbnails'] = 'http://www.roblox.local/group-thumbnails';
        Roblox.Endpoints.Urls['/headshot-thumbnail/json'] = 'http://www.roblox.local/headshot-thumbnail/json';
        Roblox.Endpoints.Urls['/item-thumbnails'] = 'http://www.roblox.local/item-thumbnails';
        Roblox.Endpoints.Urls['/outfit-thumbnail/json'] = 'http://www.roblox.local/outfit-thumbnail/json';
        Roblox.Endpoints.Urls['/place-thumbnails'] = 'http://www.roblox.local/place-thumbnails';
        Roblox.Endpoints.Urls['/thumbnail/avatar-headshot/'] = 'http://www.roblox.local/thumbnail/avatar-headshot/';
        Roblox.Endpoints.Urls['/thumbnail/avatar-headshots/'] = 'http://www.roblox.local/thumbnail/avatar-headshots/';
        Roblox.Endpoints.Urls['/thumbnail/place/'] = 'http://www.roblox.local/thumbnail/place/';
        Roblox.Endpoints.Urls['/thumbnail/user-avatar/'] = 'http://www.roblox.local/thumbnail/user-avatar/';
        Roblox.Endpoints.Urls['/thumbnail/asset/'] = 'http://www.roblox.local/thumbnail/asset/';
        Roblox.Endpoints.Urls['/thumbnail/resolve-hash/'] = 'http://www.roblox.local/thumbnail/resolve-hash/';
        Roblox.Endpoints.Urls['/thumbnail/get-asset-media'] = 'http://www.roblox.local/thumbnail/get-asset-media';
        Roblox.Endpoints.Urls['/thumbnail/remove-asset-media'] = 'http://www.roblox.local/thumbnail/remove-asset-media';
        Roblox.Endpoints.Urls['/thumbnail/set-asset-media-sort-order'] = 'http://www.roblox.local/thumbnail/set-asset-media-sort-order';
        Roblox.Endpoints.Urls['/thumbnail/place-thumbnails'] = 'http://www.roblox.local/thumbnail/place-thumbnails';
        Roblox.Endpoints.Urls['/thumbnail/place-thumbnails-partial'] = 'http://www.roblox.local/thumbnail/place-thumbnails-partial';
        Roblox.Endpoints.Urls['/thumbnail_holder/g'] = 'http://www.roblox.local/thumbnail_holder/g';
        Roblox.Endpoints.Urls['/groups/getprimarygroupinfo.ashx'] = 'http://www.roblox.local/groups/getprimarygroupinfo.ashx';
    </script>
    <script type="text/javascript">
        if (typeof (Roblox) === "undefined") { Roblox = {}; }
        Roblox.Endpoints = Roblox.Endpoints || {};
        Roblox.Endpoints.Urls = Roblox.Endpoints.Urls || {};
    </script>
    <script type="text/javascript">Roblox.XsrfToken.setToken('');</script>
    <script type="text/javascript">
        if (top.location != self.location) {
            top.location = self.location.href;
        }
    </script>
    <style type="text/css"></style>
    <form name="aspnetForm" method="post" id="aspnetForm" action="/Catalog/" class="nav-container no-gutter-ads">
        <div><input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value=""></div>
        <script
            type="text/javascript">function checkRobloxInstall() { window.location = "/Install/Unsupported.aspx"; return false; }</script>
        <script type="text/javascript"
            src="/ScriptResource.axd?d=ib_pzwkcj3RPo_km2yIH8sfg6UxkMguGnvoflV5geigq8Wp2zjm57-j3fGvbU1DrkHAJl9WDbCFavmYwY9TFjLYTQoErWHCSHA4jJN-ibc_3QBaQ0uahTA3wB96yLadfVfwexPLbN00yZdE6Ce_PYhvMDTCK0Dclq7xEoYG2fw0D1ZNgyIwZhz8awFvvBDUGq9n7g_HbecRCn5THtG6ybzixa7lRUwCjlxYIMLWBbwjtmNdf8zwLhIruKIZm7pqfF2_CZIVeJOdxULUWMUr8nd-IWzOt6Lvd6kXavT3Y6GyowiyXgaPTzyma5FL4YTmoPDbF9lDqKZUYKujZGROBiwkDRN3FLZfNM_6nEQB-CPi8OX7WAFmx_TF6l8SmOy8NaX5WLiHf5UHEEz3yYvedNobicAu7XVT3BGIZwLrgmm9zOQfdYkUdkhLc3kmxzFt1N7eU_g2"></script>
        <div><input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value=""></div>
        <div id="fb-root"></div>
        <?= SiteHeader::render() ?>
        <?= SiteAlert::render() ?>
        <div id="navContent" class="nav-content nav-no-left" style="margin-left: 0px;width: 100%;">
            <div class="nav-content-inner">
                <div id="MasterContainer" class="">
                    <script type="text/javascript">
                        $(function () {
                            function trackReturns() {
                                function dayDiff(d1, d2) {
                                    return Math.floor((d1 - d2) / 86400000);
                                }
                                var cookieName = 'RBXReturn';
                                var cookieOptions = { expires: 9001 };
                                var cookie = $.getJSONCookie(cookieName);
                                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                                    $.setJSONCookie(cookieName, { ts: new Date().toDateString() }, cookieOptions)
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
                            RobloxListener.restUrl = window.location.protocol + "//" + "roblox.local/Game/EventTracker.ashx";
                            RobloxListener.init();
                            GoogleListener.init();
                            RobloxEventManager.initialize(true);
                            RobloxEventManager.triggerEvent('rbx_evt_pageview');
                            trackReturns();
                            RobloxEventManager._singlePluginInstance = true;
                            RobloxEventManager._idleInterval = 450000;
                            RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
                            RobloxEventManager.registerCookieStoreEvent('rbx_evt_ftp');
                            RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
                            RobloxEventManager.registerCookieStoreEvent('rbx_evt_fmp');
                            RobloxEventManager.startMonitor();
                        });
                    </script>
                    <script type="text/javascript">Roblox.FixedUI.gutterAdsEnabled = false;</script>
                    <div id="Container">


                    </div>
                    <div id="AdvertisingLeaderboard" class="top-ad-728">


                        <iframe allowtransparency="true" frameborder="0" height="110" scrolling="no" src="/userads/1"
                            width="728" data-js-adtype="iframead" data-ruffle-polyfilled=""></iframe>

                    </div>
                    <noscript>
                        <div class="SystemAlert">
                            <div class="SystemAlertText">Please enable Javascript to use all the features on this site.
                            </div>
                        </div>
                    </noscript>
                    <div id="BodyWrapper">
                        <div id="RepositionBody">
                            <div id="Body" style="width:970px;">
                                <style type="text/css">
                                    #Body {
                                        padding: 5px;
                                    }
                                </style>
                                <div id="catalog">
                                    <div class="header" style="height:60px;">
                                        <div style="float:left;">
                                            <h1><a href="/catalog" id="CatalogLink">Catalog</a></h1>
                                        </div>
                                        <div class="CatalogSearchBar">
                                            <input id="keywordTextbox" name="name" type="text"
                                                class="translate text-box text-box-small">
                                            <div
                                                style="height:23px;border:1px solid #a7a7a7;padding:2px 2px 0px 2px;margin-right:6px;float:left;position:relative">
                                                <select id="categoriesForKeyword" style="">
                                                    <option value="1">All Categories</option>
                                                    <option value="0">Featured</option>
                                                    <option value="2">Collectibles</option>
                                                    <option value="3">Clothing</option>
                                                    <option value="4">Body Parts</option>
                                                    <option value="5">Gear</option>
                                                </select>
                                            </div>
                                            <a id="submitSearchButton" href="#"
                                                class="btn-control btn-control-large top-level">Search</a>
                                        </div>
                                    </div>
                                    <div class="left-nav-menu divider-right">
                                        <div class="browseDropdownHeader"></div>
                                        <div id="dropdown" class="splashdropdown roblox-hierarchicaldropdown">
                                            <ul id="dropdownUl" class="clearfix">
                                                <li class="subcategories" data-delay="never" hover="false">
                                                    <a href="#category=featured" class="assetTypeFilter"
                                                        data-category="0">Featured</a>
                                                    <ul class="slideOut" hover="false" style="top:-1px;display:none;">
                                                        <li class="slideHeader"><span>Featured Types</span></li>
                                                        <li><a href="#category=featured" class="assetTypeFilter"
                                                                data-types="0" data-category="0">All Featured Items</a>
                                                        </li>
                                                        <li><a href="#category=featured" class="assetTypeFilter"
                                                                data-types="9" data-category="0">Featured Hats</a></li>
                                                        <li><a href="#category=featured" class="assetTypeFilter"
                                                                data-types="5" data-category="0">Featured Gear</a></li>
                                                        <li><a href="#category=featured" class="assetTypeFilter"
                                                                data-types="10" data-category="0">Featured Faces</a>
                                                        </li>
                                                        <li><a href="#category=featured" class="assetTypeFilter"
                                                                data-types="11" data-category="0">Featured Packages</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="subcategories" hover="false"><a href="#category=collectibles"
                                                        class="assetTypeFilter collectiblesLink"
                                                        data-category="2">Collectibles</a>
                                                    <ul class="slideOut" hover="false" style="top:-32px;display:none;">
                                                        <li class="slideHeader"><span>Collectible Types</span></li>
                                                        <li><a href="#category=collectibles" class="assetTypeFilter"
                                                                data-types="2" data-category="2">All Collectibles</a>
                                                        </li>
                                                        <li><a href="#category=collectibles" class="assetTypeFilter"
                                                                data-types="10" data-category="2">Collectible Faces</a>
                                                        </li>
                                                        <li><a href="#category=collectibles" class="assetTypeFilter"
                                                                data-types="9" data-category="2">Collectible Hats</a>
                                                        </li>
                                                        <li><a href="#category=collectibles" class="assetTypeFilter"
                                                                data-types="5" data-category="2">Collectible Gear</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="slideHeader DropdownDivider divider-bottom"
                                                    data-delay="ignore"></li>
                                                <li data-delay="always">
                                                    <a href="#category=all" class="assetTypeFilter"
                                                        data-category="1">All
                                                        Categories</a>
                                                </li>
                                                <li class="subcategories" hover="false">
                                                    <a href="#category=clothing" class="assetTypeFilter"
                                                        data-category="3">Clothing</a>
                                                    <ul class="slideOut" hover="false" style="top:-97px;display:none;">
                                                        <li class="slideHeader"><span>Clothing Types</span></li>
                                                        <li><a href="#" class="assetTypeFilter" data-types="3"
                                                                data-category="3">All Clothing</a></li>
                                                        <li><a href="#" class="assetTypeFilter" data-types="9"
                                                                data-category="3">Hats</a></li>
                                                        <li><a href="#" class="assetTypeFilter" data-types="12"
                                                                data-category="3">Shirts</a></li>
                                                        <li><a href="#" class="assetTypeFilter" data-types="13"
                                                                data-category="3">T-Shirts</a></li>
                                                        <li><a href="#" class="assetTypeFilter" data-types="14"
                                                                data-category="3">Pants</a></li>
                                                        <li><a href="#" class="assetTypeFilter" data-types="11"
                                                                data-category="3">Packages</a></li>
                                                    </ul>
                                                </li>
                                                <li class="subcategories" hover="false"><a href="#category=bodyparts"
                                                        class="assetTypeFilter" data-category="4">Body Parts</a>
                                                    <ul class="slideOut" hover="false" style="top:-128px;display:none;">
                                                        <li class="slideHeader"><span>Body Part Types</span></li>
                                                        <li><a href="#category=bodyparts" class="assetTypeFilter"
                                                                data-types="4" data-category="4">All Body Parts</a></li>
                                                        <li><a href="#category=bodyparts" class="assetTypeFilter"
                                                                data-types="15" data-category="4">Heads</a></li>
                                                        <li><a href="#category=bodyparts" class="assetTypeFilter"
                                                                data-types="10" data-category="4">Faces</a></li>
                                                        <li><a href="#category=bodyparts" class="assetTypeFilter"
                                                                data-types="11" data-category="4">Packages</a></li>
                                                    </ul>
                                                </li>
                                                <li class="subcategories" hover="false"><a href="#category=gear"
                                                        class="assetTypeFilter" data-category="5">Gear</a>
                                                    <ul class="slideOut" hover="false"
                                                        style="top:-159px; width:auto;display:none;">
                                                        <div>
                                                            <li class="slideHeader" style="width: 150px;"><span>Gear
                                                                    Categories</span></li>
                                                            <li><a href="#geartype=All Gear" class="gearFilter"
                                                                    data-category="5" data-types="All">All Gear</a></li>
                                                            <li><a href="#geartype=Melee Weapon" class="gearFilter"
                                                                    data-category="5" data-types="1">Melee Weapon</a>
                                                            </li>
                                                            <li><a href="#geartype=Ranged Weapon" class="gearFilter"
                                                                    data-category="5" data-types="2">Ranged Weapon</a>
                                                            </li>
                                                            <li><a href="#geartype=Explosive" class="gearFilter"
                                                                    data-category="5" data-types="3">Explosive</a></li>
                                                            <li><a href="#geartype=Power Up" class="gearFilter"
                                                                    data-category="5" data-types="4">Power Up</a></li>
                                                            <li><a href="#geartype=Navigation Enhancer"
                                                                    class="gearFilter" data-category="5"
                                                                    data-types="5">Navigation Enhancer</a>
                                                            </li>
                                                            <li><a href="#geartype=Musical Instrument"
                                                                    class="gearFilter" data-category="5"
                                                                    data-types="6">Musical Instrument</a></li>
                                                        </div>
                                                        <div id="gearSecondColumn">
                                                            <li><a href="#geartype=Social Item" class="gearFilter"
                                                                    data-category="5" data-types="7">Social Item</a>
                                                            </li>
                                                            <li><a href="#geartype=Building Tool" class="gearFilter"
                                                                    data-category="5" data-types="8">Building Tool</a>
                                                            </li>
                                                            <li><a href="#geartype=Personal Transport"
                                                                    class="gearFilter" data-category="5"
                                                                    data-types="9">Personal Transport</a></li>

                                                        </div>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="legend" class="">
                                            <div class="header expanded" id="legendheader">
                                                <h3>Legend</h3>
                                            </div>
                                            <div id="legendcontent" style="overflow: hidden;">
                                                <img style="margin-left: -13px"
                                                    src="/images/4fc3a98692c7ea4d17207f1630885f68.png">
                                                <div class="legendText"><b>Builders Club Only</b><br>
                                                    Only purchasable by Builders Club members.</div>
                                                <img style="margin-left: -13px"
                                                    src="/images/793dc1fd7562307165231ca2b960b19a.png">
                                                <div class="legendText"><b>Limited Items</b><br>
                                                    Owners of these discontinued items can re-sell them to other users
                                                    at any
                                                    price.</div>
                                                <img style="margin-left: -13px"
                                                    src="/images/d649b9c54a08dcfa76131d123e7d8acc.png">
                                                <div class="legendText"><b>Limited Unique Items</b><br>
                                                    A limited supply originally sold by ROBLOX. Each unit is labeled
                                                    with a
                                                    serial number. Once sold out, owners can re-sell them to other
                                                    users.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-content divider-left">
                                        <a href="/upgrades/robux?ctx=catalog" class="btn-medium btn-primary">Buy
                                            Robux</a>
                                        <h2>Featured Items on ROBLOX</h2>
                                        <div style="clear:both;"></div>
                                        <?php foreach ($assets as $asset): ?>
                                            <?php
                                            $isBig = ($bigCount < 4);
                                            if ($isBig) {
                                                $bigCount++;
                                            } else {
                                                $smallCount++;
                                                if ($smallCount > 18)
                                                    break;
                                            }
                                            $nameSanitized = sanitizeNameForUrl($asset['Name']);
                                            $url = "/" . $nameSanitized . "-item?id=" . $asset['AssetId'];
                                            $updatedText = timeElapsedString($asset['UpdatedDate']);
                                            $ownerName = htmlspecialchars($asset['username'] ?? 'Unknown');
                                            $ownerId = (int) ($asset['OwnerId'] ?? 0);
                                            $priceInRobux = (int) ($asset['PriceInRobux'] ?? 0);
                                            $priceInTickets = (int) ($asset['PriceInTickets'] ?? 0);
                                            $isLimited = !empty($asset['Limited']);
                                            $isLimitedUnique = false; // figure this out later
                                            $isNew = false;
                                            if (!empty($asset['CreationDate'])) {
                                                try {
                                                    $created = new DateTime($asset['CreationDate']);
                                                    $isNew = $created > (new DateTime())->modify('-7 days');
                                                } catch (Exception $e) {
                                                    $isNew = false;
                                                }
                                            }
                                            ?>
                                            <div class="CatalogItemOuter <?php echo $isBig ? 'BigOuter' : 'SmallOuter'; ?>">
                                                <div
                                                    class="SmallCatalogItemView <?php echo $isBig ? 'BigView' : 'SmallView'; ?>">
                                                    <div
                                                        class="CatalogItemInner <?php echo $isBig ? 'BigInner' : 'SmallInner'; ?>">
                                                        <div class="roblox-item-image <?php echo $isBig ? 'image-large' : 'image-small'; ?>"
                                                            data-item-id="<?php echo htmlspecialchars($asset['AssetId']); ?>"
                                                            data-image-size="<?php echo $isBig ? 'large' : 'small'; ?>">
                                                            <div class="item-image-wrapper"><a href="<?php echo $url; ?>">
                                                                    <img title="<?php echo htmlspecialchars($asset['Name']) ?>"
                                                                        alt="<?php echo htmlspecialchars($asset['Name']) ?>"
                                                                        class="original-image"
                                                                        src="/Asset/?id=<?php echo htmlspecialchars($asset["AssetId"]); ?>">
                                                                    <?php if ($isLimitedUnique): ?>
                                                                        <img src="/Images/38db481d8e9c04ce960b4f49cbf94af2.png"
                                                                            alt="Limited Unique" class="limited-overlay">
                                                                    <?php endif; ?>
                                                                    <?php if ($isLimited): ?>
                                                                        <img src="/Images/793dc1fd7562307165231ca2b960b19a.png"
                                                                            alt="Limited" class="limited-overlay">
                                                                    <?php endif; ?>
                                                                    <?php if ($isNew): ?>
                                                                        <img src="/Images/b84cdb8c0e7c6cbe58e91397f91b8be8.png"
                                                                            alt="New" class="new-overlay">
                                                                    <?php endif; ?>

                                                                </a></div>
                                                        </div>
                                                        <div id="textDisplay">
                                                            <div class="CatalogItemName notranslate">
                                                                <a class="name notranslate" href="<?php echo $url; ?>"
                                                                    title="<?php echo htmlspecialchars($asset['Name']) ?>"><?php echo htmlspecialchars($asset['Name']); ?></a>
                                                            </div>
                                                            <?php if ($priceInRobux > 0): ?>
                                                                <div class="robux-price">
                                                                    <span
                                                                        class="robux notranslate"><?php echo $priceInRobux; ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if ($priceInTickets > 0): ?>
                                                                <div class="tickets-price">
                                                                    <span
                                                                        class="tickets notranslate"><?php echo $priceInTickets; ?></span>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="CatalogHoverContent">
                                                            <div><span class="CatalogItemInfoLabel">Creator:</span> <span
                                                                    class="HoverInfo notranslate"><a
                                                                        href="/user.aspx?id=<?php echo $ownerId; ?>"><?php echo $ownerName; ?></a></span>
                                                            </div>
                                                            <div><span class="CatalogItemInfoLabel">Updated:</span> <span
                                                                    class="HoverInfo"><?php echo $updatedText; ?></span>
                                                            </div>
                                                            <div><span class="CatalogItemInfoLabel">Sales:</span> <span
                                                                    class="HoverInfo notranslate"><?php echo (int) ($asset['Sales'] ?? 0); ?></span>
                                                            </div>
                                                            <div><span class="CatalogItemInfoLabel">Favorited:</span> <span
                                                                    class="HoverInfo"><?php echo (int) ($asset['Favorites'] ?? 0); ?>
                                                                    times</span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <div style="clear:both;padding-top: 50px;text-align:center;font-weight: bold;">
                                            <a href="#featured=all" class="assetTypeFilter" data-category="Featured">See
                                                all featured items</a>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        (function ($) {
                            var $menu = $('#dropdownUl');
                            function setHoverState($li, isHover) {
                                var $slide = $li.children('ul.slideOut');
                                $li.attr('hover', isHover ? 'true' : 'false');
                                $slide.attr('hover', isHover ? 'true' : 'false');
                                if (isHover) {
                                    $slide.css('display', 'block');
                                } else {
                                    $slide.css('display', 'none');
                                }
                            }
                            $menu.find('li.subcategories').each(function () {
                                var $li = $(this);
                                $li.on('mouseenter', function () {
                                    setHoverState($li, true);
                                });
                                $li.on('mouseleave', function () {
                                    setHoverState($li, false);
                                });
                            });
                        })(jQuery);
                    </script>
                    <?= SiteFooter::render() ?>
                </div>
            </div>
    </form>
</body>

</html>