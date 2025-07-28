<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

if (!$conn instanceof PDO) {
    error_log("Database connection is not a valid PDO instance");
    exit();
}

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$type = isset($_GET['type']) ? intval($_GET['type']) : 0;
$now = new DateTime();
$twentyFourHoursAgo = $now->sub(new DateInterval('PT24H'))->format('Y-m-d H:i:s');

function base64Encode($str) {
    return rtrim(strtr(base64_encode($str), '+/', '-_'), '=');
}

function base64Decode($str) {
    $pad = strlen($str) % 4;
    if ($pad) {
        $str .= str_repeat('=', 4 - $pad);
    }
    return base64_decode(strtr($str, '-_', '+/'));
}

function getBuilderClubAdRedirect() {
    return base64Encode('/Upgrades/BuildersClubMemberships.aspx');
}

function getBuilderClubAdImgSrc($type) {
    switch ($type) {
        case 1: return "/Images/Ads/BuildersClubAd-728x90v4.jpg";
        case 2: return "/Images/Ads/BuildersClubAd-160x600v4.jpg";
        case 3: return "/Images/Ads/BuildersClubAd-300x250v4.jpg";
        default: return "";
    }
}

function getAdHtml($href, $imgSrc, $width, $height, $title, $adId, $wrapperClass = "banner") {
    $reportHref = "/AbuseReport/Ad.aspx?ID=" . intval($adId) . "&RedirectUrl=/home";
    return '<html style="--wm-toolbar-height: 68px;"><head>
    <title>ROBLOX - a kids, parents, and family activity site for building toy amusement parks, rc cars, clothing, and electronic devices out of construction blocks that are as realistic as a movie or tv show</title>
    <style type="text/css">
        body { margin: 0; }
        body.banner { text-align: center; }
        a { color: gray; text-decoration: none; }
        a.ad { display: inline-block; }
        body.other a.ad { display: block; }
        a.ad img { display: block; border: none; }
        a:hover { text-decoration: underline; }
    </style>
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___6e7692e816ffb3c7713abf66d00c8ad7_m.css">
    </head>
    <body class="'.$wrapperClass.'">
        <a class="ad" target="_top" href="'.$href.'" title="'.htmlspecialchars($title).'">
            <img height="'.$height.'" width="'.$width.'" src="'.$imgSrc.'" alt="'.htmlspecialchars($title).'">
        </a>
        <div class="ad-annotations" style="width: '.$width.'px">
            <span class="ad-identification">Advertisement</span>
            <a class="BadAdButton" target="_top" title="click to report an offensive ad" href="'.$reportHref.'">Report</a>
        </div>
    </body>
    </html>';
}

function selectWeightedAd(array $ads) {
    $totalWeight = 0;
    foreach ($ads as $ad) {
        $totalWeight += $ad['Bid'];
    }
    if ($totalWeight <= 0) return null;
    $rand = mt_rand(1, $totalWeight);
    foreach ($ads as $ad) {
        $rand -= $ad['Bid'];
        if ($rand <= 0) {
            return $ad;
        }
    }
    return null;
}

if ($type < 1 || $type > 3) {    
    exit();
}

try {
    $stmt = $conn->prepare("SELECT * FROM ads WHERE \"AdType\" = :adtype AND \"BidDate\" > :cutoff");
    $stmt->execute([':adtype' => $type, ':cutoff' => $twentyFourHoursAgo]);
    $ads = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    error_log("Database query failed: " . $e->getMessage());
    exit();
}

$adToShow = null;

if (count($ads) > 0) {
    $filteredAds = [];
    foreach ($ads as $ad) {
        if ($ad['Bid'] > 0) {
            $filteredAds[] = $ad;
        }
    }
    if (count($filteredAds) > 0) {
        $adToShow = selectWeightedAd($filteredAds);
    }
}

if ($adToShow === null) {
    $redirectEncoded = getBuilderClubAdRedirect();
    $href = "/userads/redirect?data=" . $redirectEncoded;
    $imgSrc = getBuilderClubAdImgSrc($type);
    $width = 728;
    $height = 90;
    $title = "Join Today";
    switch ($type) {
        case 1:
            $width = 728;
            $height = 90;
            break;
        case 2:
            $width = 160;
            $height = 600;
            break;
        case 3:
            $width = 300;
            $height = 250;
            break;
    }
    echo getAdHtml($href, $imgSrc, $width, $height, $title, 0, $type == 1 ? "banner" : "other");
    exit();
}

$adId = intval($adToShow['AdId']);
$decodedUrl = base64Decode($adToShow['AdUrl']);
$href = "/userads/redirect?data=" . base64Encode($decodedUrl);
$imgSrc = "/userads/images/" . $adId . ".png";
$title = htmlspecialchars($adToShow['AdName']);

try {
    $updateStmt = $conn->prepare("UPDATE ads SET \"Views\" = \"Views\" + 1, \"TotalViews\" = \"TotalViews\" + 1 WHERE \"AdId\" = :adid");
    $updateStmt->execute([':adid' => $adId]);
} catch (Exception $e) {
    error_log("Failed to update ad views: " . $e->getMessage());
}

$width = 728;
$height = 90;
$wrapperClass = "banner";
switch ($type) {
    case 1:
        $width = 728;
        $height = 90;
        $wrapperClass = "banner";
        break;
    case 2:
        $width = 160;
        $height = 600;
        $wrapperClass = "other";
        break;
    case 3:
        $width = 300;
        $height = 250;
        $wrapperClass = "other";
        break;
}

echo getAdHtml($href, $imgSrc, $width, $height, $title, $adId, $wrapperClass);
exit();
?>
