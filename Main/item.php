<?php
// written by chloe and meditext
// i had to change some stuff to be complient with the existing system.

require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
use UserControls\Navigation\SiteAlert;
use Roblox\AssetType;


function sanitizeNameForUrl(string $name): string {
    $name = preg_replace('/[^a-zA-Z0-9 -]/', '', $name);
    $name = str_replace(' ', '-', $name);
    $name = preg_replace('/-+/', '-', $name);
    $name = trim($name, '-');
    return $name;
}

function genreCssClass(string $genre): string {
    $mapping = [
        'All Genres' => 'All',
        'Tutorial' => 'Tutorial',
        'Scary' => 'Scary',
        'Town and City' => 'Town and City',
        'War' => 'War',
        'LOL' => 'Funny',
        'Fantasy' => 'Fantasy',
        'Adventure' => 'Adventure',
        'Sci-Fi' => 'Sci-Fi',
        'Naval' => 'Pirate',
        'FPS' => 'FPS',
        'RPG' => 'RPG',
        'Sports' => 'Sports',
        'Ninja' => 'Ninja',
        'Wild West' => 'Wild West',
    ];
    return $mapping[$genre] ?? 'All';
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: /requesterror?code=404");
    exit;
}

$stmt = $conn->prepare('SELECT * FROM assets WHERE "AssetId" = :id');
$stmt->execute([':id' => $id]);
$asset = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$asset) {
    header("Location: /requesterror?code=404");
    exit;
}

$assetType = AssetType::get((int)$asset['AssetType']);
if (!$assetType) {
    header("Location: /requesterror?code=404");
    exit;
}
//$plural = AssetType::getValuePluralized($assetType->value);

$stmtUser = $conn->prepare('SELECT * FROM users WHERE "id" = :ownerId');
$stmtUser->execute([':ownerId' => $asset['OwnerId']]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

$nameSanitized = sanitizeNameForUrl($asset['Name']);
$expectedUrl = '/' . $nameSanitized . '-item?id=' . $asset['AssetId'];

$currentPath = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($currentPath);
$path = $parsedUrl['path'] ?? '';
$query = $parsedUrl['query'] ?? '';

if (strpos($path, $nameSanitized . '-item') === false) {
    header("Location: $expectedUrl");
    exit;
}

$limitedOverlay = $asset['Limited'] ? '<img id="ctl00_cphRoblox_ItemLimitedOverlay" alt="Limited" style="position:absolute;bottom:0px;margin-left:-28px;z-index:1;left:0px;" src="/images/ecf6b4f4789665e0e4f45d202fa740c7.png">' : '';

$assetImageUrl = "/Thumbs/Asset.ashx?ID=" . $asset['AssetId'];

$userProfileUrl = "/User.aspx?ID=" . $user['id'];
$userThumbUrl = "/Thumbs/Avatar.ashx?userId=" . $user['id'];
$userName = htmlspecialchars($user['username'], ENT_QUOTES);

$createdDate = $asset['CreationDate'] ? date("n/j/Y", strtotime($asset['CreationDate'])) : 'Unknown';
$updatedDate = $asset['UpdatedDate'] ? humanTiming(strtotime($asset['UpdatedDate'])) . " ago" : 'Unknown';

function humanTiming($time)
{
    $time = time() - $time;
    $time = ($time < 1) ? 1 : $time;
    $tokens = [
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    ];
    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
    }
}

$description = htmlspecialchars($asset['Description'] ?: 'No description available.', ENT_QUOTES);

$reportUrl = "/AbuseReport/Asset.aspx?ID={$asset['AssetId']}&RedirectUrl=" . urlencode($expectedUrl);

$genre = 'All Genres';
$genreCss = genreCssClass($genre);
$genreLink = strtolower(str_replace(' ', '-', $genre)) . '-games';

$hash = $_SERVER['REQUEST_URI'] ?? '';
$selectedTab = 'RecommendationsTab';
if (strpos($hash, '#CommentaryTab') !== false) {
    $selectedTab = 'CommentaryTab';
} elseif (strpos($hash, '#RecommendationsTab') !== false) {
    $selectedTab = 'RecommendationsTab';
}

$stmtRecs = $conn->prepare('
    SELECT a."AssetId", a."OwnerId", a."AssetType", a."Name", u.username 
    FROM assets a 
    JOIN users u ON u.id = a."OwnerId" 
    WHERE a."AssetType" != 9 AND a."OwnerId" = 1
    ORDER BY a."CreationDate" DESC
    LIMIT 10
');
$stmtRecs->execute();
$recommendations = $stmtRecs->fetchAll(PDO::FETCH_ASSOC);

function tabClass($tabId, $selectedTab) {
    return 'StandardPanelWhite TabContent' . ($tabId === $selectedTab ? ' selected' : '');
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" xmlns:fb="http://www.facebook.com/2008/fbml" style="--wm-toolbar-height: 1px;"><head id="ctl00_Head1">
<head id="ctl00_Head1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">
<title>
    <?php echo htmlspecialchars($asset['Name'], ENT_QUOTES); ?>, a <?php echo htmlspecialchars($assetType->value, ENT_QUOTES); ?> by <?php echo $userName ?> - <?php echo $site_properties['Title']; ?> (updated <?php echo date("n/j/Y g:i:s A", strtotime($asset['UpdatedDate'])); ?>)
</title>

<script type="text/javascript" src="http://cdn.gigya.com/js/gigya.js?apiKey=3_OsvmtBbTg6S_EUbwTPtbbmoihFY5ON6v6hbVrTbuqpBs7SyF_LQaJwtwKJ60sY1p"></script>
    
<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=main___1cacbba05e42ebf55ef7a6de7f5dd3f0_m.css' />

<link rel='stylesheet' href='/CSS/Base/CSS/FetchCSS?path=page___53eeb36e90466af109423d4e236a59bd_m.css' />
<link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en-us" />
<meta name="author" content="ROBLOX Corporation" />
<meta id="ctl00_metadescription" name="description" content="<?php echo htmlspecialchars($asset['Name'], ENT_QUOTES); ?>, a <?php echo htmlspecialchars($assetType->value, ENT_QUOTES); ?> by <?php echo $userName ?> - <?php echo $site_properties['Title']; ?> (updated <?php echo date("n/j/Y g:i:s A", strtotime($asset['UpdatedDate'])); ?>" />
<meta id="ctl00_metakeywords" name="keywords" content="virtual good <?php echo htmlspecialchars($asset['Name']); ?>, a <?php echo htmlspecialchars($assetType->value, ENT_QUOTES); ?> by <?php echo $userName ?> - <?php echo $site_properties['Title']; ?> (updated <?php echo date("n/j/Y g:i:s A", strtotime($asset['UpdatedDate'])); ?> items, ROBLOX <?php echo htmlspecialchars($asset['Name']); ?>, a <?php echo htmlspecialchars($assetType->value, ENT_QUOTES); ?> by <?php echo $userName ?> - <?php echo $site_properties['Title']; ?> (updated <?php echo date("n/j/Y g:i:s A", strtotime($asset['UpdatedDate'])); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
	    	<script type="text/javascript">

        var _gaq = _gaq || [];

		    _gaq.push(['_setAccount', 'UA-11419793-1']);
		    _gaq.push(['_setCampSourceKey', 'rbx_source']);
		    _gaq.push(['_setCampMediumKey', 'rbx_medium']);
		    _gaq.push(['_setCampContentKey', 'rbx_campaign']);
		        _gaq.push(['_setDomainName', 'aftwld.xyz']);
		_gaq.push(['b._setAccount', 'UA-486632-1']);
		_gaq.push(['b._setCampSourceKey', 'rbx_source']);
		_gaq.push(['b._setCampMediumKey', 'rbx_medium']);
		_gaq.push(['b._setCampContentKey', 'rbx_campaign']);

		_gaq.push(['b._setDomainName', 'aftwld.xyz']);
        
            _gaq.push(['b._setCustomVar', 1, 'Visitor', 'Anonymous', 2]);
            _gaq.push(['b._trackPageview']);    
        
        
        

		_gaq.push(['c._setAccount', 'UA-26810151-2']);
		_gaq.push(['c._setDomainName', 'aftwld.xyz']);

		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();

	</script>
<div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer)\.roblox\.com|robloxlabs\.com)((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))" data-regex-flags="gm"></div><script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
<script type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
<script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
<script type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>
<script type='text/javascript' src='//js.rbxcdn.com/50cb8c7590b75499925be4825ab1fb8f.js'></script>
<script type='text/javascript'>Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = '//js.rbxcdn.com/a2ff3787d1fd8d3c2492b5f5c5ec70b6.js';Roblox.config.paths['Pages.CatalogShared'] = '//js.rbxcdn.com/4eb48eec34ca711d5a7b08a4291ac753.js';Roblox.config.paths['Pages.Messages'] = '//js.rbxcdn.com/e8cbac58ab4f0d8d4c707700c9f97630.js';Roblox.config.paths['Resources.Messages'] = '//js.rbxcdn.com/fb9cb43a34372a004b06425a1c69c9c4.js';Roblox.config.paths['Widgets.AvatarImage'] = '//js.rbxcdn.com/bbaeb48f3312bad4626e00c90746ffc0.js';Roblox.config.paths['Widgets.DropdownMenu'] = '//js.rbxcdn.com/7b436bae917789c0b84f40fdebd25d97.js';Roblox.config.paths['Widgets.GroupImage'] = '//js.rbxcdn.com/33d82b98045d49ec5a1f635d14cc7010.js';Roblox.config.paths['Widgets.HierarchicalDropdown'] = '//js.rbxcdn.com/fbb86cf0752d23f389f983419d3085b4.js';Roblox.config.paths['Widgets.ItemImage'] = '//js.rbxcdn.com/838ec9c8067ba6fd6793a8bdbdb48a5c.js';Roblox.config.paths['Widgets.PlaceImage'] = '//js.rbxcdn.com/f2697119678d0851cfaa6c2270a727ed.js';Roblox.config.paths['Widgets.SurveyModal'] = '//js.rbxcdn.com/d6e979598c460090eafb6d38231159f6.js';</script><script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script><script type='text/javascript' src='//js.rbxcdn.com/db95b7bf9a4587f82d242e5a2fc3fc30.js'></script>

    <script type="text/javascript">
function Roblox_Item_Top_728x90_RTP(estimate){rtp['/1015347/Roblox_Item_Top_728x90'] = rp_valuation.estimate;}
var rtp = rtp || {};
oz_api="valuation";oz_site="9874/18868";oz_zone="58960";oz_ad_slot_size="728x90";oz_callback=Roblox_Item_Top_728x90_RTP;
</script><script type="text/javascript" src="http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script><script>

function Roblox_Item_Right_160x600_RTP(estimate){rtp['/1015347/Roblox_Item_Right_160x600'] = rp_valuation.estimate;}
var rtp = rtp || {};
oz_api="valuation";oz_site="9874/18868";oz_zone="58960";oz_ad_slot_size="160x600";oz_callback=Roblox_Item_Right_160x600_RTP;
</script><script type="text/javascript" src="http://tap-cdn.rubiconproject.com/partner/scripts/rubicon/dorothy.js?pc=9874/18868"></script><script>

    googletag.cmd.push(function() {
        Roblox = Roblox || {};
        Roblox.AdsHelper = Roblox.AdsHelper || {};
        Roblox.AdsHelper.slots = [];
        Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Item_Top_728x90", [728, 90], "3133333934333635").addService(googletag.pubads()), id: "3133333934333635", path: "/1015347/Roblox_Item_Top_728x90"});
Roblox.AdsHelper.slots = Roblox.AdsHelper.slots || []; Roblox.AdsHelper.slots.push({slot:googletag.defineSlot("/1015347/Roblox_Item_Right_160x600", [160, 600], "3632323431393436").addService(googletag.pubads()), id: "3632323431393436", path: "/1015347/Roblox_Item_Right_160x600"});

        for (var key in Roblox.AdsHelper.slots) {
            var slot = Roblox.AdsHelper.slots[key].slot;
            var id = Roblox.AdsHelper.slots[key].id;
            var path = Roblox.AdsHelper.slots[key].path;

                     slot.setTargeting('pos', path);
                                             slot.setTargeting('tier', rtp[path].tier);
            if (slot.renderEnded != "undefined") {
                (function(slot, id)
                {
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
                    googletag.pubads().setTargeting("Env",  "Production");
                    googletag.pubads().setTargeting("AssetID", "<?php echo htmlspecialchars($asset['AssetId']); ?>");
                                        googletag.pubads().enableSingleRequest();
        googletag.pubads().collapseEmptyDivs();
        googletag.enableServices();
    });
    </script>  
</head>
<body data-twttr-rendered="true">
<form name="aspnetForm" method="post" action="<?= htmlspecialchars($expectedUrl) ?>" id="aspnetForm">

<div id="MasterContainer">
<?= SiteHeader::render() ?>

<div id="AdvertisingLeaderboard">
    <iframe allowtransparency="true" frameborder="0" height="90" scrolling="no" width="828" src="/userads/1"></iframe>
</div>

<div id="BodyWrapper">
    <div id="RepositionBody"><div id="Body" style="width:970px;">

    <div id="ItemContainer" class="text">
        <div>
            <h1 class="notranslate" data-se="item-name"><?= htmlspecialchars($asset['Name']) ?></h1>
            <h3>
                ROBLOX <?= htmlspecialchars($assetType->value) ?>
            </h3>
        </div>
        <div id="Item">
            <div id="Details">
                <div id="assetContainer">
                    <div id="Thumbnail" style="position:relative;">
                        <a id="ctl00_cphRoblox_AssetThumbnailImage" disabled="disabled" class="AssetThumbnailImage" title="<?= htmlspecialchars($asset['Name']) ?>" onclick="return false" style="display:inline-block;height:320px;width:320px;">
                            <img height="320" width="320" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?= htmlspecialchars($asset['Name']) ?>" src="<?= $assetImageUrl ?>">
                        </a>
                        <?= $limitedOverlay ?>
                    </div>
                </div>
                <div id="Summary">
                    <div class="SummaryDetails">
                        <div id="Creator" class="Creator">
                            <div class="Avatar">
                                <a id="ctl00_cphRoblox_AvatarImage" class="tooltip-right" href="<?= htmlspecialchars($userProfileUrl) ?>" style="display:inline-block;height:70px;width:70px;cursor:pointer;" original-title="<?= htmlspecialchars($userName) ?>">
                                    <img height="70" width="70" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?= htmlspecialchars($userName) ?>" src="<?= htmlspecialchars($userThumbUrl) ?>">
                                </a>
                            </div>
                        </div>
                        <div class="item-detail">
                            <span class="stat-label notranslate">Creator:</span>
                            <a id="ctl00_cphRoblox_CreatorHyperLink" class="stat notranslate" href="User.aspx?ID=<?= $user['id'] ?>"><?= $userName ?></a>
                            <div>
                                <span class="stat-label">Created:</span>
                                <span class="stat"><?= $createdDate ?></span>
                            </div>
                            <div id="LastUpdate">
                                <span class="stat-label">Updated:</span>
                                <span class="stat"><?= $updatedDate ?></span>
                            </div>
                        </div>
                        <div id="ctl00_cphRoblox_DescriptionPanel" class="DescriptionPanel notranslate">
                            <pre class="Description Full text"><?= $description ?></pre>
                            <pre class="Description body text"><?= $description ?></pre>
                        </div>
                        <div class="ReportAbuse">
                            <div id="ctl00_cphRoblox_AbuseReportButton1_AbuseReportPanel" class="ReportAbuse">
                                <span class="AbuseIcon">
                                    <a id="ctl00_cphRoblox_AbuseReportButton1_ReportAbuseIconHyperLink" href="<?= htmlspecialchars($reportUrl) ?>">
                                        <img src="/images/abuse.PNG" alt="Report Abuse" style="border-width:0px;">
                                    </a>
                                </span>
                                <span class="AbuseButton">
                                    <a id="ctl00_cphRoblox_AbuseReportButton1_ReportAbuseTextHyperLink" href="<?= htmlspecialchars($reportUrl) ?>">Report Abuse</a>
                                </span>
                            </div>
                        </div>
                        <div class="GearGenreContainer divider-top">
                            <div id="GenresDiv">
                                <div id="ctl00_cphRoblox_Genres">
                                    <div class="stat-label">Genres:</div>
                                    <div class="GenreInfo stat">
                                        <div>
                                            <div class="GamesInfoIcon <?= htmlspecialchars(str_replace(' ', '.', $genreCss)) ?>"></div>
                                            <div><a href="/<?= htmlspecialchars($genreLink) ?>"><?= htmlspecialchars($genre) ?></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="BuyPriceBoxContainer">
                        <div class="BuyPriceBox">
                            <div class="clear"></div>
                            <div class="PrivateSalesPurchasePanel" id="ctl00_cphRoblox_PrivateSalesPurchasePanel">
                                <span class="Price ">
                                    Best Price: <span class="robux " data-se="item-privatesale-price"><?= intval($asset['PriceInRobux']) ?></span>
                                </span>
                                <div class="roblox-buy-now btn-primary btn-medium PurchaseButton" data-se="item-privatesale-buyforbestprice" data-item-name="<?= htmlspecialchars($asset['Name']) ?>" data-item-id="<?= $asset['AssetId'] ?>" data-expected-price="<?= intval($asset['PriceInRobux']) ?>">
                                    Buy Now
                                    <span class="btn-text">Buy Now</span>
                                </div>
                            </div>
                            <div class="footnote">
                                <div id="ctl00_cphRoblox_Sold_Limited">( <span data-se="item-numbersold"><span class="stat">0</span></span> Sold )</div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <span><span class="FavoriteStar" data-se="item-numberfavorited">0</span></span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>

            <div id="Tabs">
                <ul id="TabHeader" class="WhiteSquareTabsContainer">
                    <li id="RecommendationsTabHeader" contentid="RecommendationsTab" class="SquareTabGray ItemTabs selected">
                        <span><a id="RecommendationsLink" href="#RecommendationsTab">Recommendations</a></span>
                    </li>
                    <li id="CommentaryTabHeader" contentid="CommentaryTab" class="SquareTabGray ItemTabs">
                        <span><a id="CommentaryLink" href="#CommentaryTab">Commentary</a></span>
                    </li>
                </ul>
                <div class="StandardPanelContainer">
                    <div id="ScriptReviewTab" class="StandardPanelWhite TabContent"></div>
                    <div id="RecommendationsTab" class="<?php echo tabClass('RecommendationsTab', $selectedTab); ?>">
                        <div class="AssetRecommenderContainer">
                            <table id="ctl00_cphRoblox_AssetRec_dlAssets" cellspacing="0" align="Center" border="0" style="height:175px;width:800px;border-collapse:collapse;">
                                <tbody>
                                    <?php
                                    $counter = 0;
                                    foreach ($recommendations as $index => $assetRec) {
                                        if ($counter % 5 === 0) {
                                            echo '<tr>';
                                        }
                                        $sanitizedName = sanitizeNameForUrl($assetRec['Name']);
                                        $assetUrl = '/' . $sanitizedName . '-item?id=' . $assetRec['AssetId'];
                                        $userUrl = '/User.aspx?ID=' . $assetRec['OwnerId'];
                                        ?>
                                        <td>
                                            <div class="PortraitDiv" style="width: 140px; height: 165px; overflow: hidden;margin:auto;" visible="True" data-se="recommended-items-<?php echo $index; ?>">
                                                <div class="AssetThumbnail">
                                                    <a id="ctl00_cphRoblox_AssetRec_dlAssets_ctl<?php echo str_pad($index, 2, '0', STR_PAD_LEFT); ?>_AssetThumbnailHyperLink" title="<?php echo htmlspecialchars($assetRec['Name'], ENT_QUOTES); ?>" style="display:inline-block;height:110px;width:110px;cursor:pointer;" href="<?php echo $assetUrl; ?>">
                                                        <img height="110" width="110" border="0" onerror="return Roblox.Controls.Image.OnError(this)" alt="<?php echo htmlspecialchars($assetRec['Name'], ENT_QUOTES); ?>" src="/Thumbs/Asset.ashx?ID=<?php echo $assetRec['AssetId']; ?>">
                                                    </a>
                                                </div>
                                                <div class="AssetDetails">
                                                    <div class="AssetName noTranslate">
                                                        <a id="ctl00_cphRoblox_AssetRec_dlAssets_ctl<?php echo str_pad($index, 2, '0', STR_PAD_LEFT); ?>_AssetNameHyperLinkPortrait" href="<?php echo $assetUrl; ?>">
                                                            <?php echo htmlspecialchars($assetRec['Name'], ENT_QUOTES); ?>
                                                        </a>
                                                    </div>
                                                    <div class="AssetCreator">
                                                        <span class="stat-label">Creator:</span> 
                                                        <span class="Detail stat">
                                                            <a id="ctl00_cphRoblox_AssetRec_dlAssets_ctl<?php echo str_pad($index, 2, '0', STR_PAD_LEFT); ?>_CreatorHyperLinkPortrait" class="notranslate" href="<?php echo $userUrl; ?>">
                                                                <?php echo htmlspecialchars($assetRec['username'], ENT_QUOTES); ?>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                        $counter++;
                                        if ($counter % 5 === 0) {
                                            echo '</tr>';
                                        }
                                    }
                                    if ($counter % 5 !== 0) {
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    
                        <script type="text/javascript">
                            $(function () {
                                var itemNames = $('.PortraitDiv .AssetDetails .AssetName a');
                                $.each(itemNames, function (index) {
                                    var elem = $(itemNames[index]);
                                    elem.html(fitStringToWidthSafe(elem.html(), 200));
                                });
                                var userNames = $('.PortraitDiv .AssetDetails .AssetCreator .Detail a');
                                $.each(userNames, function (index) {
                                    var elem = $(userNames[index]);
                                    elem.html(fitStringToWidthSafe(elem.html(), 70));
                                });
                            });
                        </script>
                    </div>
                    
                    <div id="CommentaryTab" class="<?php echo tabClass('CommentaryTab', $selectedTab); ?>">
                        <div id="ctl00_cphRoblox_CommentsPane_CommentsUpdatePanel">
                            <div id="AjaxCommentsPaneData" data-comments-floodcheck="3600"></div>
                            <div class="AjaxCommentsContainer">
                                <div class="Comments" data-asset-id="<?php echo (int)$asset['AssetId']; ?>"></div>
                                <div class="CommentsItemTemplate">
                                    <div class="Comment text">
                                        <div class="Commenter">
                                            <div class="Avatar" data-user-id="%CommentAuthorID" data-image-size="small"></div>
                                        </div>
                                        <div class="PostContainer">
                                            <div class="Post">
                                                <div class="Audit">
                                                    <span class="ByLine footnote">Posted %CommentCreated ago by <a href="/web/20130622020708/http://www.roblox.com/user.aspx?id=%CommentAuthorID">%CommentAuthor</a></span>
                                                    <div class="ReportAbuse">
                                                        <span class="AbuseButton">
                                                            <a href="AbuseReport/Comment.aspx?ID=%CommentID&amp;RedirectUrl=%PageURL">Report Abuse</a>
                                                        </span>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                </div>
                                                <div class="Content">%CommentContent</div>
                                                <div id="Actions" class="Actions">
                                                    <a data-comment-id="%CommentID" class="DeleteCommentButton">Delete Comment</a>
                                                </div>
                                            </div>
                                            <div class="PostBottom"></div>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <script type="text/javascript">
                            Roblox.CommentsPane.Resources = {
                                floodCheckString: 'You may only post a comment once every ',
                                seconds: " seconds",
                                noCommentsFound: 'No comments found.',
                                moreComments: 'More comments',
                                sorrySomethingWentWrong: 'Sorry, something went wrong.',
                                charactersRemaining: ' characters remaining',
                                emailVerifiedABTitle:"Verify Your Email",
                                emailVerifiedABMessage:"You must verify your email before you can comment. You can verify your email on the <a href='/My/Account.aspx?confirmemail=1'>Account</a> page.",
                                accept:"Verify",
                                decline:"Cancel"
                            };
                        </script>
                    </div>
                </div>
            </div>

        </div>
        <div class="Ads_WideSkyscraper">
            <iframe allowtransparency="true" frameborder="0" height="612" scrolling="no" width="160" src="/userads/2"></iframe>
        </div>
        <div class="clear"></div>
    </div>

</div></div>
</div>
</form>
<?= SiteFooter::render() ?>
</body>
</html>
