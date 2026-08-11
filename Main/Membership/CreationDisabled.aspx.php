<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';
use UserControls\Navigation\SiteHeader;
use UserControls\Navigation\SiteFooter;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Account Creation Disabled - RBLX.local</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=main___7000c43d73500e63554d81258494fa21_m.css">
    <link rel="stylesheet" href="/CSS/Base/CSS/FetchCSS?path=page___486ee4e2def9b96aeaf9ebb663ab510e_m.css">
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.1.min.js'></script>
    <script
        type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-1.11.1.js'><\/script>")</script>
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/jquery.migrate/jquery-migrate-1.2.1.min.js'></script>
    <script
        type='text/javascript'>window.jQuery || document.write("<script type='text/javascript' src='/js/jquery/jquery-migrate-1.2.1.js'><\/script>")</script>
    <script type='text/javascript' src='//ajax.aspnetcdn.com/ajax/4.0/1/MicrosoftAjax.js'></script>
    <script
        type='text/javascript'>window.Sys || document.write("<script type='text/javascript' src='/js/Microsoft/MicrosoftAjax.js'><\/script>")</script>

</head>

<body>
    <div class="wrap">
        <?= SiteHeader::render() ?>
        <div class="container-main">
            <div class="content">
                <div style="margin:150px auto;width:500px;border:black thin solid;padding:22px;">
                    <span style="font-weight:bold;">Account creation has been suspended.</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
