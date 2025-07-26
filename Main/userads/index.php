<?php
$type = isset($_GET['type']) ? $_GET['type'] : null;

switch ($type) {
    case '1':
        echo '<html style="--wm-toolbar-height: 68px;"><head>
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
        <body class="banner">
            <a class="ad" target="_top" href="/userads/redirect?data=L1VwZ3JhZGVzL0J1aWxkZXJzQ2x1Yk1lbWJlcnNoaXBzLmFzcHg" title="Join Today">
                <img height="90" width="728" src="/Images/Ads/BuildersClubAd-728x90v4.jpg" alt="Join Today">
            </a>
            <div class="ad-annotations" style="width: 728px">
                <span class="ad-identification">Advertisement</span>
                <a class="BadAdButton" target="_top" title="click to report an offensive ad" href="/RobloxDefaultErrorPage.aspx?code=404">Report</a>
            </div>
        </body>
        </html>';
        break;

    case '2':
        echo '<html style="--wm-toolbar-height: 68px;"><head>
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
        <body class="other">
            <a class="ad" title="Join Today" target="_top" href="/userads/redirect?data=L1VwZ3JhZGVzL0J1aWxkZXJzQ2x1Yk1lbWJlcnNoaXBzLmFzcHg">
                <img alt="Join Today" height="600" width="160" src="/Images/Ads/BuildersClubAd-160x600v4.jpg">
            </a>
            <div class="ad-annotations" style="width: 160px">
                <span class="ad-identification">Advertisement</span>
                <a class="BadAdButton" target="_top" title="click to report an offensive ad" href="/RobloxDefaultErrorPage.aspx?code=404">Report</a>
            </div>
        </body>
        </html>';
        break;

    case '3':
        echo '<html style="--wm-toolbar-height: 68px;"><head>
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
        <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___5bcb079cc22f40d09a57aa5c592fb7b4_m.css">
        </head>
        <body class="other">
            <a class="ad" target="_top" href="/userads/redirect?data=L1VwZ3JhZGVzL0J1aWxkZXJzQ2x1Yk1lbWJlcnNoaXBzLmFzcHg" title="Join Today">
                <img height="250" width="300" src="/Images/Ads/BuildersClubAd-300x250v4.jpg" alt="Join Today">
            </a>
            <div class="ad-annotations" style="width: 300px">
                <span class="ad-identification">Advertisement</span>
                <a class="BadAdButton" target="_top" title="click to report an offensive ad" href="/RobloxDefaultErrorPage.aspx?code=404">Report</a>
            </div>
        </body>
        </html>';
        break;

    default:
        header("Location: /RobloxDefaultErrorPage.aspx?code=404");
        exit();
}
?>
