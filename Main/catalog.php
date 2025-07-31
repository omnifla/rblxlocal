<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

function sanitizeNameForUrl(string $name): string {
    $name = preg_replace('/[^a-zA-Z0-9 -]/', '', $name);
    $name = str_replace(' ', '-', $name);
    $name = preg_replace('/-+/', '-', $name);
    $name = trim($name, '-');
    return $name;
}

function timeElapsedString($datetime, $full = false) {
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

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

$stmt = $conn->prepare("
    SELECT a.*, u.username 
    FROM assets a 
    LEFT JOIN users u ON a.OwnerId = u.id 
    WHERE a.OwnerId = 1 
    ORDER BY a.UpdatedDate DESC 
    LIMIT 22
");
$stmt->execute();
$assets = $stmt->fetchAll(PDO::FETCH_ASSOC);

$bigCount = 0;
$smallCount = 0;

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" style="--wm-toolbar-height: 1px;">
<head id="ctl00_Head1">









<meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true"><title>
	Avatar Items, Virtual Avatars, Virtual Goods
</title>
<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___48afe50e39f7798f5c4b881f356eff20_m.css">

<link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___ea443401e3a604005e686af4a0180ed3_m.css">
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta http-equiv="Content-Language" content="en-us"><meta name="author" content="ROBLOX Corporation"><meta id="ctl00_metadescription" name="description" content="User-generated MMO gaming site for kids, teens, and adults. Players architect their own worlds. Builders create free online games that simulate the real world. Create and play amazing 3D games. An online gaming cloud and distributed physics engine."><meta id="ctl00_metakeywords" name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine">
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-11419793-1']);
    _gaq.push(['_setCampSourceKey', 'rbx_source']);
    _gaq.push(['_setCampMediumKey', 'rbx_medium']);
    _gaq.push(['_setCampContentKey', 'rbx_campaign']);
    
    
    
    _gaq.push(['b._setAccount', 'UA-486632-1']);
    _gaq.push(['b._setCampSourceKey', 'rbx_source']);
    _gaq.push(['b._setCampMediumKey', 'rbx_medium']);
    _gaq.push(['b._setCampContentKey', 'rbx_campaign']);

    
        _gaq.push(['c._setAccount', 'UA-26810151-2']);
    

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://web.archive.org/web/20130226184057/https://ssl' : 'https://web.archive.org/web/20130226184057/http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>
<script type="text/javascript" src="//web.archive.org/web/20130226184057js_/http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.2.min.js"></script>
<script type="text/javascript">window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.7.2.min.js'><\/script>")</script>
<script type="text/javascript" src="//web.archive.org/web/20130226184057js_/http://ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js"></script>
<script type="text/javascript">window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

<script type="text/javascript" src="https://web.archive.org/web/20130226184057js_/http://jsak.roblox.com/e314b234db0e03eec9e972421351df89.js"></script>
<script type="text/javascript">Roblox.config.externalResources = ['/js/jquery/jquery-1.7.2.min.js','/js/json2.min.js'];Roblox.config.paths['jQuery'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/29cf397a226a92ca602cb139e9aae7d7.js';Roblox.config.paths['Pagelets.BestFriends'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/c8acaba4214074ed4ad6f8b4a9647038.js';Roblox.config.paths['Pages.Catalog'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/7ad0cc4e0732a00fff80b669dcad25ff.js';Roblox.config.paths['Pages.Messages'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/154c74a9b82cc96c455342a29b9181ed.js';Roblox.config.paths['Widgets.AvatarImage'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/b7f418a5fefacfd21f2c86b495b4698f.js';Roblox.config.paths['Widgets.DropdownMenu'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/62fb655f45f69688fa60965add1380c8.js';Roblox.config.paths['Widgets.GroupImage'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/3e692c7b60e1e28ce639184f793fdda9.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/e8b579b8e31f8e7722a5d10900191fe7.js';Roblox.config.paths['Widgets.ItemImage'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/facde7fc56e53e1ef9ee75203bc76bb4.js';Roblox.config.paths['Widgets.PlaceImage'] = 'https://web.archive.org/web/20130226184057/http://jsak.roblox.com/08e1942c5b0ef78773b03f02bffec494.js';</script>
    <script type="text/javascript">Roblox.JSErrorTracker.initialize({'internalEventListenerPixelEnabled': true});</script>

<script type="text/javascript" src="https://web.archive.org/web/20130226184057js_/http://jsak.roblox.com/c3eabef541db3635f6cfdc1e7b21ab14.js"></script>

<script type="text/javascript" src="https://web.archive.org/web/20130226184057js_/http://jsak.roblox.com/c89f93934e866904b7e2c6cf9653b112.js"></script>

        <script type="text/javascript">   
            googletag.cmd.push(function() {
	        googletag.defineSlot("/1015347/Roblox_Catalog_Top_728x90", [728, 90], "3231383639313533").addService(googletag.pubads());
 
            googletag.pubads().setTargeting("Age", "Unknown");
            googletag.pubads().enableSingleRequest();
            googletag.enableServices();
	        });
        </script>  
        <script async="true" type="text/javascript" src="https://web.archive.org/web/20130226184057/https://s.adroll.com/j/roundtrip.js"></script><script async="true" type="text/javascript" src="https://web.archive.org/web/20130226184057js_///d.adroll.com/pixel/SUG2BASJ2ZDT3EM44FOGOG/LFNDR3AF4BCD5KDK67TTLO?pv=59529320987.65432&amp;cookie=&amp;keyw="></script>
</head>
<body roblox-js-usercheckcontrollerenabled="False" class="">
    <script type="text/javascript">Roblox.XsrfToken.setToken('');</script>
    <style type="text/css"></style>
    <form name="aspnetForm" method="post" id="aspnetForm" action="/Catalog/">
        <div><input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value=""></div>
        <script type="text/javascript">function checkRobloxInstall(){window.location="/Install/Unsupported.aspx"; return false;}</script>
        <script type="text/javascript" src="https://web.archive.org/web/20130226184057js_/http://www.roblox.com/ScriptResource.axd?d=ib_pzwkcj3RPo_km2yIH8sfg6UxkMguGnvoflV5geigq8Wp2zjm57-j3fGvbU1DrkHAJl9WDbCFavmYwY9TFjLYTQoErWHCSHA4jJN-ibc_3QBaQ0uahTA3wB96yLadfVfwexPLbN00yZdE6Ce_PYhvMDTCK0Dclq7xEoYG2fw0D1ZNgyIwZhz8awFvvBDUGq9n7g_HbecRCn5THtG6ybzixa7lRUwCjlxYIMLWBbwjtmNdf8zwLhIruKIZm7pqfF2_CZIVeJOdxULUWMUr8nd-IWzOt6Lvd6kXavT3Y6GyowiyXgaPTzyma5FL4YTmoPDbF9lDqKZUYKujZGROBiwkDRN3FLZfNM_6nEQB-CPi8OX7WAFmx_TF6l8SmOy8NaX5WLiHf5UHEEz3yYvedNobicAu7XVT3BGIZwLrgmm9zOQfdYkUdkhLc3kmxzFt1N7eU_g2"></script>
        <div><input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value=""></div>
        <div id="fb-root"></div>
        <div id="MasterContainer" class="">
            <script type="text/javascript">
                $(function(){
                    function trackReturns() {
                        function dayDiff(d1, d2) {
                            return Math.floor((d1-d2)/86400000);
                        }
                        var cookieName = 'RBXReturn';
                        var cookieOptions = {expires:9001};
                        var cookie = $.getJSONCookie(cookieName);
                        if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                            $.setJSONCookie(cookieName, {ts:new Date().toDateString()}, cookieOptions)
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
                    RobloxEventManager._singlePluginInstance = true;
                    RobloxEventManager._idleInterval = 450000;
                    RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
                    RobloxEventManager.registerCookieStoreEvent('rbx_evt_ftp');
                    RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
                    RobloxEventManager.registerCookieStoreEvent('rbx_evt_fmp');
                    RobloxEventManager.startMonitor();
                });
            </script>
            <script type="text/javascript">Roblox.FixedUI.gutterAdsEnabled=false;</script>
            <noscript><div class="SystemAlert"><div class="SystemAlertText">Please enable Javascript to use all the features on this site.</div></div></noscript>
            <div id="BodyWrapper">
                <div id="RepositionBody"><div id="Body" style="width:970px;">
                    <div id="catalog">
                        <div class="header" style="height:60px;">
                            <div style="float:left;">
                                <a href="/web/20130226184057/http://www.roblox.com/catalog/" id="CatalogLink" class="StandardHeaderTopLvl">Catalog</a>
                            </div>
                            <div class="CatalogSearchBar">
                                <input id="keywordTextbox" name="name" type="text" class="translate text-box text-box-small" value="">
                                <div style="height:23px;border:1px solid #a7a7a7;padding:2px 2px 0px 2px;margin-right:6px;float:left;position:relative">
                                    <select id="categoriesForKeyword" style="">
                                        <option value="1">All Categories</option>
                                        <option value="0">Featured</option>
                                        <option value="2">Collectibles</option>
                                        <option value="3">Clothing</option>
                                        <option value="4">Body Parts</option>
                                        <option value="5">Gear</option>
                                        <option value="7">Decals</option>
                                        <option value="6">Models</option>
                                        <option value="8">Audio</option>
                                    </select>
                                </div>
                                <a id="submitSearchButton" href="#" class="btn-form top-level">Search</a>
                            </div>
                        </div>
                        <div class="left-nav-menu StandardDividerRight">
                            <a id="BrowseCategoriesButton" class="browseDropdownButton hover roblox-hierarchicaldropdownbutton"></a>
                            <div id="dropdown" class="splashdropdown roblox-hierarchicaldropdown">
                                <ul id="dropdownUl">
                                    <li class="subcategories" data-delay="never">
                                        <a href="#category=featured" class="assetTypeFilter" data-category="0">Featured</a>
                                        <ul class="slideOut" style="top: -1px; display: none;" hover="false">
                                            <li class="slideHeader"><span>Featured Types</span></li>
                                            <li><a href="#category=featured" class="assetTypeFilter" data-types="0" data-category="0">All Featured Items</a></li>
                                            <li><a href="#category=featured" class="assetTypeFilter" data-types="8" data-category="0">Featured Hats</a></li>
                                            <li><a href="#category=featured" class="assetTypeFilter" data-types="5" data-category="0">Featured Gear</a></li>
                                            <li><a href="#category=featured" class="assetTypeFilter" data-types="9" data-category="0">Featured Faces</a></li>
                                            <li><a href="#category=featured" class="assetTypeFilter" data-types="10" data-category="0">Featured Packages</a></li>
                                        </ul>
                                    </li>
                                    <li class="subcategories"><a href="#category=collectibles" class="assetTypeFilter collectiblesLink" data-category="2">Collectibles</a>
                                        <ul class="slideOut" style="top: -32px; display: none;" hover="false">
                                            <li class="slideHeader"><span>Collectible Types</span></li>
                                            <li><a href="#category=collectibles" class="assetTypeFilter" data-types="2" data-category="2">All Collectibles</a></li>
                                            <li><a href="#category=collectibles" class="assetTypeFilter" data-types="9" data-category="2">Collectible Faces</a></li>
                                            <li><a href="#category=collectibles" class="assetTypeFilter" data-types="8" data-category="2">Collectible Hats</a></li>
                                            <li><a href="#category=collectibles" class="assetTypeFilter" data-types="5" data-category="2">Collectible Gear</a></li>
                                        </ul>
                                    </li>
                                    <li class="slideHeader DropdownDivider StandardDividerBottom" data-delay="ignore"></li>
                                    <li data-delay="always">
                                        <a href="#category=all" class="assetTypeFilter" data-category="1">All Categories</a>
                                    </li>
                                    <li class="subcategories">
                                        <a href="#category=clothing" class="assetTypeFilter" data-category="3">Clothing</a>
                                        <ul class="slideOut" style="top: -97px; display: none;" hover="false">
                                            <li class="slideHeader"><span>Clothing Types</span></li>
                                            <li><a href="#" class="assetTypeFilter" data-types="3" data-category="3">All Clothing</a></li>
                                            <li><a href="#" class="assetTypeFilter" data-types="8" data-category="3">Hats</a></li>
                                            <li><a href="#" class="assetTypeFilter" data-types="11" data-category="3">Shirts</a></li>
                                            <li><a href="#" class="assetTypeFilter" data-types="12" data-category="3">T-Shirts</a></li>
                                            <li><a href="#" class="assetTypeFilter" data-types="13" data-category="3">Pants</a></li>
                                            <li><a href="#" class="assetTypeFilter" data-types="10" data-category="3">Packages</a></li>
                                        </ul>
                                    </li>
                                    <li class="subcategories"><a href="#category=bodyparts" class="assetTypeFilter" data-category="4">Body Parts</a>
                                        <ul class="slideOut" style="top: -128px; display: none;" hover="false">
                                            <li class="slideHeader"><span>Body Part Types</span></li>
                                            <li><a href="#category=bodyparts" class="assetTypeFilter" data-types="4" data-category="4">All Body Parts</a></li>
                                            <li><a href="#category=bodyparts" class="assetTypeFilter" data-types="14" data-category="4">Heads</a></li>
                                            <li><a href="#category=bodyparts" class="assetTypeFilter" data-types="9" data-category="4">Faces</a></li>
                                            <li><a href="#category=bodyparts" class="assetTypeFilter" data-types="10" data-category="4">Packages</a></li>
                                        </ul>
                                    </li>
                                    <li class="subcategories"><a href="#category=gear" class="assetTypeFilter" data-category="5">Gear</a>
                                        <ul class="slideOut" style="top: -159px; display: none;" hover="false">
                                            <div>
                                                <li class="slideHeader" style="width: 150px;"><span>Gear Categories</span></li>
                                                <li><a href="#geartype=All Gear" class="gearFilter" data-category="5" data-types="All">All Gear</a></li>
                                                <li><a href="#geartype=Melee Weapon" class="gearFilter" data-category="5" data-types="1">Melee Weapon</a></li>
                                                <li><a href="#geartype=Ranged Weapon" class="gearFilter" data-category="5" data-types="2">Ranged Weapon</a></li>
                                                <li><a href="#geartype=Explosive" class="gearFilter" data-category="5" data-types="3">Explosive</a></li>
                                                <li><a href="#geartype=Power Up" class="gearFilter" data-category="5" data-types="4">Power Up</a></li>
                                                <li><a href="#geartype=Navigation Enhancer" class="gearFilter" data-category="5" data-types="5">Navigation Enhancer</a></li>
                                                <li><a href="#geartype=Musical Instrument" class="gearFilter" data-category="5" data-types="6">Musical Instrument</a></li>
                                            </div>
                                            <div id="gearSecondColumn">
                                                <li><a href="#geartype=Social Item" class="gearFilter" data-category="5" data-types="7">Social Item</a></li>
                                                <li><a href="#geartype=Building Tool" class="gearFilter" data-category="5" data-types="8">Building Tool</a></li>
                                                <li><a href="#geartype=Personal Transport" class="gearFilter" data-category="5" data-types="9">Personal Transport</a></li>
                                            </div>
                                        </ul>
                                    </li>
                                    <li><a href="#category=models" class="assetTypeFilter" data-category="6">Models</a></li>
                                    <li><a href="#category=decals" class="assetTypeFilter" data-category="7">Decals</a></li>
                                    <li><a href="#category=audio" class="assetTypeFilter" data-category="8">Audio</a></li>
                                </ul>
                            </div>
                            <div id="legend" class="">
                                <div class="header expanded" id="legendheader">
                                    <span class="StandardHeader2ndLvl">Legend</span>
                                </div>
                                <div id="legendcontent" style="overflow: hidden; display: block;">
                                    <img style="margin-left: -13px" src="/images/4fc3a98692c7ea4d17207f1630885f68.png">
                                    <div class="legendText"><b>Builders Club Only</b><br>
                                    Only purchasable by Builders Club members.</div>
                                    <img style="margin-left: -13px" src="/images/793dc1fd7562307165231ca2b960b19a.png">
                                    <div class="legendText"><b>Limited Items</b><br>
                                    Owners of these discontinued items can re-sell them to other users at any price.</div>
                                    <img style="margin-left: -13px" src="/images/d649b9c54a08dcfa76131d123e7d8acc.png">
                                    <div class="legendText"><b>Limited Unique Items</b><br>
                                    A limited supply originally sold by ROBLOX. Each unit is labeled with a serial number. Once sold out, owners can re-sell them to other users.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="right-content StandardDividerLeft">
                            <span class="bolded selected">Featured Items on ROBLOX</span>
                            <div style="clear:both;"></div>
                            <?php foreach ($assets as $asset): ?>
                                <?php
                                    $isBig = ($bigCount < 4);
                                    if ($isBig) {
                                        $bigCount++;
                                    } else {
                                        $smallCount++;
                                        if ($smallCount > 18) break;
                                    }
                                    $nameSanitized = sanitizeNameForUrl($asset['Name']);
                                    $url = "/" . $nameSanitized . "-item?id=" . $asset['AssetId'];
                                    $updatedText = timeElapsedString($asset['UpdatedDate']);
                                    $ownerName = htmlspecialchars($asset['username'] ?? 'Unknown');
                                    $ownerId = (int)($asset['OwnerId'] ?? 0);
                                ?>
                                <div class="CatalogItemOuter <?php echo $isBig ? 'BigOuter' : 'SmallOuter'; ?>">
                                    <div class="SmallCatalogItemView <?php echo $isBig ? 'BigView' : 'SmallView'; ?>">
                                        <div class="CatalogItemInner <?php echo $isBig ? 'BigInner' : 'SmallInner'; ?>">    
                                            <div class="roblox-item-image <?php echo $isBig ? 'image-large' : 'image-small'; ?>" data-item-id="<?php echo htmlspecialchars($asset['AssetId']); ?>" data-image-size="<?php echo $isBig ? 'large' : 'small'; ?>"></div>
                                            <div id="textDisplay">
                                                <div class="CatalogItemName notranslate">
                                                    <a href="<?php echo $url; ?>" class="notranslate"><?php echo htmlspecialchars($asset['Name']); ?></a>
                                                </div>
                                                <div class="CatalogItemOwner">
                                                    <a href="/user.aspx?id=<?php echo $ownerId; ?>" class="notranslate"><?php echo $ownerName; ?></a>
                                                </div>
                                                <div class="CatalogItemPrice">
                                                    <span class="PriceInRobux notranslate">R$: <?php echo (int)$asset['PriceInRobux']; ?></span>
                                                    <span class="PriceInTickets notranslate">T$: <?php echo (int)$asset['PriceInTickets']; ?></span>
                                                </div>
                                                <div class="CatalogItemUpdated">
                                                    <span><?php echo $updatedText; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div style="clear: both;"></div>
                            <div id="CatalogBottomSpacer"></div>
                        </div>
                    </div>
                </div></div>
            </div>
        </div>
    </form>
</body>
</html>
